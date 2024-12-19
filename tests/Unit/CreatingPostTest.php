<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatingPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_post()
    {
        $user = User::factory()->create(); // Create a user to associate with the post
        $post = Post::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'content' => $post->content,
            'user_id' => $post->user_id,
        ]);
    }

    public function test_post_creation_validation()
    {
        $response = $this->post('/posts', []); // Try to create a post with invalid data
        $response->assertSessionHasErrors(['title', 'content']);
    }
}
