<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Repositories\CommentRepo;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $postId)
    {
        return CommentService::getAllComments($postId);
    }

    public function store(Request $request, string $postId)
    {
        return CommentService::createComment($request, $postId);
    }


    public function update(Request $request, string $commentId)
    {
        $comment = CommentService::findComment($commentId);
        if(!$comment){
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }

        $this->authorize('update', $comment);
        return CommentService::updateComment($request, $comment);
    }


    public function destroy(string $commentId)
    {
        $comment = CommentService::findComment($commentId);
        if(!$comment){
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }

        $this->authorize('delete', $comment);
        return CommentService::deleteComment($comment);
    }

    public function upload(FileUploadRequest $request, $commentId){
        $comment = CommentService::findComment($commentId);
        if(!$comment){
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
        $this->authorize('upload', $comment);
        return CommentService::upload($request, $commentId);
    }
}
