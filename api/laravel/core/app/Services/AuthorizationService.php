<?php

namespace App\Services;

use App\Http\Requests\AuthorizationRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\GameList;
use App\Models\User;
use App\Services\Interfaces\IAuthorizationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthorizationService implements IAuthorizationService
{

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

    private function createGameLists($userId, $listName): void
    {
        GameList::create([
            'name' => $listName,
            'user_id' => $userId,
        ]);
    }
    public function registration(RegistrationRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $user = User::create([
            'login' => $validatedData['login'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);




        $this->createGameLists($user->id, 'Wishlist');
        $this->createGameLists($user->id, 'Completed');

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }
}
