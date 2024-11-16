<?php

namespace App\Services;

use App\Repositories\UserRepo;
use App\Utils\Utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;



class AuthService{
    public static function register($request){
        UserRepo::createNewUser($request);
        return response()->json([
            'message' => 'Đăng ký thành công.',
        ], 201);
    }

    public static function login($request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
                'message' => 'Đăng nhập thành công.',
                'access_token' => Utils::createAccessToken(),
        ]);

    }

    public static function logout($request){
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Đăng xuất thành công.'
        ]);
    }

}
