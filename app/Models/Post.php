<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'views',
        'isPublished'
    ];

    protected $hidden = [
        'isPublished'
    ];
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
