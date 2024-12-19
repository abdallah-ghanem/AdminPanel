<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

class Comment extends Model
{

    /**
 * @OA\Schema(
 *     schema="Comment",
 *     type="object",
 *     required={"content", "post_id", "user_id"},
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="content", type="string"),
 *     @OA\Property(property="post_id", type="integer"),
 *     @OA\Property(property="user_id", type="integer"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */

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
