<?php

namespace App\Services;

use App\Models\Comment;
use App\Repositories\CommentRepo;
use App\Repositories\PostRepo;
use App\Utils\Utils;
use Illuminate\Support\Facades\File;

use function App\Utils\randomFileName;

class CommentService{
    public static function findComment($commentId){
        return CommentRepo::findCommentById($commentId);
    }
    
    public static function getAllComments($postId){
        $post = PostRepo::findPostById($postId);
        if(!$post){
            return response()->json([
                'message' => 'Not found'
            ], 400);
        }
        return response()->json([
            'message' => 'Success',
            CommentRepo::findCommentByPost($post)
        ]);
    }


    public static function createComment($comment, $postId){
        $post = PostRepo::findPostById($postId);
        if(!$post || $post->isPublished === false){
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
        return response()->json([
            'message' => 'Success',
            CommentRepo::createComment($comment, $postId)
        ]);
    }

    public static function updateComment($newComment, $oldComment){
        return response()->json([
            'message' => 'Success',
            CommentRepo::updateComment($newComment, $oldComment)
        ]);
    }

    public static function deleteComment($comment){
        CommentRepo::deleteComment($comment);
        return response()->json([
            'message' => 'Success'
        ]);
    }

    public static function upload($request, $commentId){
        $file = $request->file('file');
            $fileName = Utils::randomFileName($file);
            $des = base_path('public/uploads');
            $file->move($des, $fileName);
            if (!File::exists($des)) {
                File::makeDirectory($des, 0666, true);
            }
            $file_path = 'uploads/' . $fileName;
            CommentRepo::createCommentFile($file_path, $commentId);
            return response()->json([
                'message' => 'File uploaded successfully',
                'file_path' => '/'.$file_path
            ]);
    }

}
