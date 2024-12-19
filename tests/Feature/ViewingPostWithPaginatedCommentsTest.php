<?php

namespace Tests\Feature;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewingPostWithPaginatedCommentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_post_with_paginated_comments()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        Comment::factory()->count(10)->create(['post_id' => $post->id]); // Create 10 comments for the post

        $response = $this->get("/posts/{$post->id}");
        $response->assertStatus(200);
        $response->assertViewHas('post', $post);
        $response->assertViewHas('comments');
    }

    public function test_show_post_with_custom_per_page()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        Comment::factory()->count(15)->create(['post_id' => $post->id]);

        // Requesting the post with a custom per_page value
        $response = $this->get("/posts/{$post->id}?per_page=5");
        $response->assertStatus(200);
        $response->assertViewHas('comments', function ($comments) {
            return $comments->count() == 5;  // Verify there are only 5 comments per page
        });
    }
}
