<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function upload(FileUploadRequest $request){
        return UserService::upload($request);
    }

    public function search(Request $request){
        return UserService::search($request->query('q'));
    }
}
