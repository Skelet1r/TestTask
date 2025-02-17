<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function createAccount(Request $request)
    {
        return $this->authService->createAccount($request);
    }

    public function signIn(Request $request)
    {
        return $this->authService->signIn($request);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }
}
