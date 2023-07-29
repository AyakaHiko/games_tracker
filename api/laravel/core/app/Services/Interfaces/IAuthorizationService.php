<?php

namespace app\Services\Interfaces;

use App\Http\Requests\AuthorizationRequest;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\JsonResponse;

interface IAuthorizationService
{
    public function logout();
    public function login(AuthorizationRequest $request);
    public function registration(RegistrationRequest $request);
    public function getUser();


}
