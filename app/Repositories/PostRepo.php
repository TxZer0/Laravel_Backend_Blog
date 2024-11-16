<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\PostFile;

class PostRepo{
    public static function findAllPost(){
        return response()->json(
            Post::where('isPublished', true)->paginate(10)
        );
    }


    public static function createPost($newPost){
        return Post::create([
            'title' => $newPost->title,
            'content' => $newPost->content,
            'user_id' => auth()->user()->id,
            'views' => 0,
            'isPublished' => false
        ]);
    }

    public static function findPostById($postId){
        return Post::find($postId);
    }

    public static function updatePost($oldPost, $newPost){
        if($newPost->has('title')){
            $oldPost->title = $newPost->title;
        }

        if($newPost->has('content')){
            $oldPost->content = $newPost->content;
        }
        $oldPost->save();
        return $oldPost;
    }

    public static function deletePost($post){
        return $post->delete();
    }


    public static function createPostFile($file_path, $postId){
        return PostFile::create([
            'post_id' => $postId,
            'path' => $file_path
        ]);
    }

    public static function publishPost($post){
        $post->isPublished = true;
        $post->save();
        return $post;
    }

    public static function searchPost($keySearch){
        return Post::selectRaw("*, MATCH(title, content) AGAINST(?) AS score", [$keySearch])
                ->whereRaw("MATCH(title, content) AGAINST(?)", [$keySearch])
                ->orderByDesc('score')
                ->paginate(10);
    }
}
