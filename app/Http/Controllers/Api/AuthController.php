<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\SignInRequest;
use App\Http\Requests\Api\Auth\SignUpRequest;
use App\Http\Services\Api\AuthService;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $auth,
    )
    {
    }

    public function register(SignUpRequest $request)
    {
        return $this->auth->register($request);
    }

    public function login(SignInRequest $request)
    {
        return $this->auth->login($request);
    }

    public function logout()
    {
        return $this->auth->logout();
    }
}
