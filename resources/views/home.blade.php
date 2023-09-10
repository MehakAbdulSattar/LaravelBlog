@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Posts</h1>

    @foreach ($posts as $post)
    <div class="row mb-4">
        <div class="col-md-4 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-dark">{{ $post->title }}</h2> <!-- Add the text-dark class for dark text color -->
                </div>

                @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="card-img-top">
                @endif

                <div class="card-body">
                    <p class="card-text">{{ $post->description }}</p>

                    <!-- Display the User who created the Post -->
                    <p class="card-text">Created by: {{ $post->user->name }}</p>

                    <!-- Display Previous Comments -->
                    <ul class="list-unstyled">
                        @foreach ($post->comments as $comment)
                        <li>
                            @php
                            $user = App\Models\User::find($comment->user_id); // Replace 'App\User' with the actual namespace of your User model
                            @endphp
                            @if ($user)
                            <strong>{{ $user->name }}:</strong>
                            @endif
                            {{ $comment->text }}
                        </li>
                        @endforeach
                    </ul>

                    <!-- Comment Form -->
                    <form action="{{ route('comments.store', $post) }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-group">
                            <input type="text" name="text" class="form-control" placeholder="Add a comment">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Add Comment</button>
                    </form>
                </div>

                <div class="card-footer text-right">
                    @can('update', $post)
                    <a href="{{ route('post.edit', $post) }}" class="btn btn-primary btn-sm">Edit</a>
                    @endcan

                    @can('delete', $post)
                    <form action="{{ route('post.destroy', $post) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
