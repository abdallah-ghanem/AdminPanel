<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a newly created comment for a post
    public function store(Request $request, $postId)
    {
        // Validate the incoming request
        $request->validate([
            'content' => 'required',
        ]);

        // Store the comment
        Comment::create([
            'content' => $request->content,
            'post_id' => $postId, // Assuming you're associating the comment with a post
            'user_id' => Auth::id(), // Get the authenticated user's ID
        ]);

        return redirect()->route('posts.show', $postId)->with('success', 'Comment added successfully!');
    }



    // Update a comment
    public function edit($postId, $commentId)
    {
        // Find the post and comment
        $post = Post::findOrFail($postId);
        $comment = Comment::findOrFail($commentId);


        // Return the edit view with the comment
        return view('comments.edit', compact('post', 'comment'));
    }

    public function update(Request $request, $postId, $commentId)
    {
        // Validate the content of the comment
        $request->validate([
            'content' => 'required',
        ]);

        // Find the comment and update it
        $comment = Comment::findOrFail($commentId);
        $this->authorize('update', $comment);
        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('posts.show', $postId)->with('success', 'Comment updated successfully!');
    }

    // Delete a comment
    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->route('posts.show', $post->id)->with('success', 'Comment deleted successfully');
    }
}
