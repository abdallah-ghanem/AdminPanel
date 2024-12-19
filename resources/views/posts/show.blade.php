@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>

        <h2>Comments</h2>

        <!-- Dropdown to select comments per page -->
        <form method="GET" action="{{ route('posts.show', $post->id) }}">
            <label for="per_page">Comments per page:</label>
            <select name="per_page" id="per_page" onchange="this.form.submit()">
                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
            </select>
        </form>

        <!-- Display comments -->
        @foreach($comments as $comment)
            <div>
                <p>{{ $comment->content }}</p>

                <!-- Edit Comment Button -->
                <a href="{{ route('comments.edit', ['post' => $post->id, 'comment' => $comment->id]) }}" class="btn btn-warning btn-sm">Edit Comment</a>

                <!-- Delete Comment Form -->
                <form action="{{ route('posts.comments.destroy', [$post->id, $comment->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete Comment</button>
                </form>
            </div>
        @endforeach

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $comments->appends(['per_page' => $perPage])->links() }}
        </div>

        <!-- Add Comment Form -->
        <h3>Add Comment</h3>
        <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
            @csrf
            <textarea name="content" class="form-control" rows="3" required></textarea>
            <button type="submit" class="btn btn-primary mt-3">Add Comment</button>
        </form>
    </div>
@endsection
