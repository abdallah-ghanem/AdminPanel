<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeletingPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_post_as_authenticated_user()
{
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user); // Acting as the authenticated user

    // Make a delete request to the post
    $response = $this->delete("/posts/{$post->id}");

    // Assert that the user is redirected back to the posts index page
    $response->assertRedirect('/posts');

    // Assert that the post is deleted from the database
    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);
}

}
