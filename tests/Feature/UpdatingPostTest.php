<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdatingPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_post_as_authenticated_user()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);  // Authenticate the user

        // Test updating a post
        $response = $this->put("/posts/{$post->id}", [
            'title' => 'Updated Post Title',
            'content' => 'Updated content for the post.',
        ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', [
            'title' => 'Updated Post Title',
            'content' => 'Updated content for the post.',
        ]);
    }
}
