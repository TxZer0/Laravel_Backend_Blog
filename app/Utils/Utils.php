<?php
namespace App\Utils;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Utils{
    public static function createAccessToken(){
        $user = Auth::user();
        return $user->createToken('auth')->plainTextToken;
    }

    public static function randomFileName($file){
        return Str::random(32) . '.' . $file->getClientOriginalExtension();
    }
}

