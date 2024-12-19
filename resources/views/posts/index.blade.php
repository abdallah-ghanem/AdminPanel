// resources/views/posts/index.blade.php

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $posts->appends(['per_page' => $perPage])->links() }}
    </div>
    </div>
@endsection
