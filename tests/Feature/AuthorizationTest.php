<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user cannot update another user's post.
     *
     * @return void
     */
    public function test_user_cannot_update_others_post()
    {
        // Create two users
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        // Create a post owned by the second user
        $post = Post::factory()->create(['user_id' => $otherUser->id]);

        // Act as the first user
        $this->actingAs($user);

        // Attempt to update a post that doesn't belong to the authenticated user
        $response = $this->put("/posts/{$post->id}", [
            'title' => 'New Title',
            'content' => 'Updated content.',
        ]);

        // Assert that the response status is 403 (Forbidden)
        $response->assertStatus(403);

        // Optionally, you can assert that the post's content and title haven't changed
        $post->refresh();  // Reload the post from the database
        $this->assertNotEquals('New Title', $post->title);
        $this->assertNotEquals('Updated content.', $post->content);
    }
}
