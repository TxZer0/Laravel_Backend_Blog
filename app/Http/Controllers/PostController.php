<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Repositories\PostRepo;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return PostService::getAllPosts();
    }


    public function store(StorePostRequest $request)
    {
        return PostService::createPost($request);
    }


    public function show(string $id)
    {
        return PostService::findPost($id);
    }

    public function update(Request $request, string $id)
    {
        $post = PostRepo::findPostById($id);
        if(!$post){
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
        $this->authorize('update', $post);
        return PostService::updatePost($post, $request);
    }


    public function destroy(string $id)
    {
        $post = PostRepo::findPostById($id);
        if(!$post){
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
        $this->authorize('delete', $post);
        return PostService::deletePost($post);
    }

    public function upload(FileUploadRequest $request,string $postId){
        $post = PostRepo::findPostById($postId);
        if(!$post){
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
        $this->authorize('upload', $post);
        return PostService::upload($request, $postId);
    }

    public function publish(string $postId){
        $post = PostRepo::findPostById($postId);
        if(!$post){
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
        $this->authorize('publish', $post);
        return PostService::publishPost($post);
    }
}
