<?php

namespace App\Services;

use App\Repositories\PostRepo;
use App\Utils\Utils;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function App\Utils\randomFileName;

class PostService{
    public static function findPost($postId){
        return PostRepo::findPostById($id);
    }
    
    public static function getAllPosts(){
        return response()->json([
            'message' => 'Success',
            PostRepo::findAllPost()
        ]);
    }


    public static function createPost($newPost){
        return response()->json([
            'message' => 'Created',
            PostRepo::createPost($newPost)
        ]);
    }

    public static function findPost($postId){
        $post = PostRepo::findPostById($postId);
        if(!$post){
            return response()->json([
                    'message' => 'Not found'
            ],404);
        }

        $checkOwner = $post->user_id === auth()->id();
        $publish = $post->isPublished !== false;
        if(!$checkOwner && !$publish){
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        if($publish && !$checkOwner){
            $post->increment('views');
        }
        return response()->json([
            'message' => 'Success',
            $post
        ]);
    }

    public static function updatePost($oldPost, $newPost){
        return response()->json([
            'message' => 'Update successfully',
            PostRepo::updatePost($oldPost, $newPost)
        ]);
    }

    public static function deletePost($post){
        PostRepo::deletePost($post);
        return response()->json([
            'message' => 'Update successfully',
        ]);
    }


    public static function upload($request, $postId)
    {
        $file = $request->file('file');
        $fileName = Utils::randomFileName($file);
        $des = base_path('public/uploads');
        $file->move($des, $fileName);
        if (!File::exists($des)) {
            File::makeDirectory($des, 0666, true);
        }
        $file_path = 'uploads/' . $fileName;
        PostRepo::createPostFile($file_path, $postId);
        return response()->json([
            'message' => 'File uploaded successfully',
            'file_path' => '/'.$file_path
        ]);
    }

    public static function publishPost($post){
        return PostRepo::publishPost($post);
    }
}
