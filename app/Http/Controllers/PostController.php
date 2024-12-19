<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Display a list of posts with pagination
    public function index(Request $request)
    {
    // Get the number of posts per page from the query parameter or default to 5
    $perPage = $request->get('per_page', 5);

    // Fetch paginated posts
    $posts = Post::paginate($perPage);

    // Pass the paginated posts and the selected perPage value to the view
    return view('posts.index', compact('posts', 'perPage'));
    }


    // Show a single post
    // Show a post with paginated comments
    public function show($postId, Request $request)
    {
        // Fetch post
        $post = Post::findOrFail($postId);

        // Pagination setup: fetch comments and allow user to set per-page items
        $perPage = $request->get('per_page', 3);
        $comments = $post->comments()->paginate($perPage);

        return view('posts.show', compact('post', 'comments', 'perPage'));
    }

    // Show the form to create a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store a newly created post
    public function store(Request $request)
{
    // Validate request
    $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    // Create a new post using mass assignment
    $post = Post::create([
        'title' => $request->title,
        'content' => $request->content,
        'user_id' => Auth::id(), // Get the currently authenticated user's ID
    ]);

    return redirect()->route('posts.index')->with('success', 'Post created successfully!');
}

    // Show the form to edit a post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Update an existing post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $this->authorize('update', $post);
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    // Delete a post
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
