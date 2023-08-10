<?php

namespace App\Services;

use App\Http\Requests\AuthorizationRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\GameList;
use App\Models\ListType;
use App\Models\User;
use App\Services\Interfaces\IAuthorizationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthorizationService implements IAuthorizationService
{
    protected $cacheMinutes = 10;
    public function getUser(): JsonResponse
    {
        Log::debug('getUser');
        if (Auth::check()) {
            $user = Auth::user();
            return response()->json([
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'message' => 'User not authenticated',
            ], 401);
        }
    }
    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out',
        ]);
    }

    public function login(AuthorizationRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ],201);
    }

    private function createGameLists($userId, $listName, $listTypeId): void
    {
        GameList::create([
            'name' => $listName,
            'user_id' => $userId,
            'list_type_id'=>$listTypeId,
            'is_delitable' =>false
        ]);
    }
    private function addDefaultLists($userId)
    {
        $listTypeNames = ['wishlist', 'completed', 'uncompleted'];

        foreach ($listTypeNames as $listTypeName) {
            $listTypeId = Cache::remember($listTypeName . '_id', $this->cacheMinutes, function () use ($listTypeName) {
                return ListType::where('name', $listTypeName)->value('id');
            });

            $this->createGameLists($userId, ucfirst($listTypeName), $listTypeId);
        }
    }
    public function registration(RegistrationRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $user = User::create([
                'login' => $validatedData['login'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
            $this->addDefaultLists($user->id);

            DB::commit();

            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error occurred. User registration failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
