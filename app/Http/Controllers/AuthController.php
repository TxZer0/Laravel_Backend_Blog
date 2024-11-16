<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request){
        return AuthService::register($request);
    }

    public function login(UserLoginRequest $request){
        return AuthService::login($request);
    }

    public function logout(Request $request){
        return AuthService::logout($request);
    }
}
