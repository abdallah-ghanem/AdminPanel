@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Comment</h3>

        <!-- Display errors if there are any validation issues -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Comment edit form -->
        <form action="{{ route('posts.comments.update', ['post' => $post->id, 'comment' => $comment->id]) }}" method="POST">
            @csrf
            @method('PUT') <!-- Indicate that we are updating the resource -->

            <!-- Textarea for editing the comment content -->
            <div class="form-group">
                <label for="content">Comment Content:</label>
                <textarea name="content" id="content" class="form-control" rows="4" required>{{ old('content', $comment->content) }}</textarea>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary mt-3">Update Comment</button>
        </form>

        <!-- Back to Post link -->
        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary mt-3">Back to Post</a>
    </div>
@endsection
