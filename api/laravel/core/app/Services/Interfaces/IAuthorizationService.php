<?php

namespace App\Services\Interfaces;

use App\Http\Requests\AuthorizationRequest;
use App\Http\Requests\RegistrationRequest;

interface IAuthorizationService
{
    public function logout();
    public function login(AuthorizationRequest $request);
    public function registration(RegistrationRequest $request);

}
