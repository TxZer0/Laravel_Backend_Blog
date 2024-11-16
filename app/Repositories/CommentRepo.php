<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\CommentFile;

class CommentRepo{
    public static function findCommentByPost($post){
        return $post->comments;
    }

    public static function findCommentById($commentId){
        return Comment::find($commentId);
    }

    public static function createComment($newComment, $postId){
        return Comment::create([
            'content' => $newComment->content,
            'post_id' => $postId,
            'user_id' => auth()->id()
        ]);
    }

    public static function deleteComment($comment){
        $comment->delete();
    }

    public static function updateComment($newComment, $oldComment){
        $oldComment->content = $newComment->content;
        $oldComment->save();
        return $oldComment;
    }

    public static function createCommentFile($file_path, $postId){
        CommentFile::create([
            'comment_id' => $postId,
            'path' => $file_path
        ]);
    }
}
