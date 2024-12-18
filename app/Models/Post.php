<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'user_id'];

    // Define relationship to comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Define relationship to user (author of the post)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
