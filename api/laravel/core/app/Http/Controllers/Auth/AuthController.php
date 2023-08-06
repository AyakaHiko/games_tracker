<?php

namespace App\Http\Controllers\Auth;


use App\Http\Requests\AuthorizationRequest;
use App\Http\Requests\RegistrationRequest;
use App\Services\Interfaces\IAuthorizationService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(protected IAuthorizationService $authorizationService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(AuthorizationRequest $request)
    {
        return $this->authorizationService->login($request);
    }

    public function register(RegistrationRequest $request)
    {
        return $this->authorizationService->registration($request);
    }

    public function logout()
    {
        return $this->authorizationService->logout();
    }
    public function getUser(){
        return $this->authorizationService->getUser();
    }


    public function refresh()
    {
        return response()->json([
            'success' => true,
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
