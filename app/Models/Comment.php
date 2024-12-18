<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'post_id', 'user_id'];

    // Define relationship to post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Define relationship to user (author of the comment)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
