<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepo{
    public static function createNewUser($request){
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }


    public static function upload($file_path){
        $user = auth()->user();
        $user->avatar = $file_path;
        $user->save();
    }


}
