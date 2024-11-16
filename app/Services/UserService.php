<?php

namespace App\Services;

use App\Repositories\PostRepo;
use App\Repositories\UserRepo;
use App\Utils\Utils;
use Illuminate\Support\Facades\File;

use function App\Utils\randomFileName;

class UserService{
    public static function upload($request){
        $file = $request->file('file');
        $fileName = Utils::randomFileName($file);
        $des = base_path('public/uploads');
        $file->move($des, $fileName);
        if (!File::exists($des)) {
            File::makeDirectory($des, 0666, true);
        }
        $file_path = 'uploads/' . $fileName;

        UserRepo::upload($file_path);
        return response()->json([
            'message' => 'File uploaded successfully',
            'file_path' => '/'.$file_path
        ]);
    }

    public static function search($keySearch){
        return response()->json([
            'message' => 'Success',
            'Result' => PostRepo::searchPost($keySearch)
        ]);
    }


}
