<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

class Post extends Model
{
    /**
 * @OA\Schema(
 *     schema="Post",
 *     type="object",
 *     required={"title", "content", "user_id"},
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="content", type="string"),
 *     @OA\Property(property="user_id", type="integer"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
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
