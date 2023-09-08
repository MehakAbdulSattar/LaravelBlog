<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>

    <ul>
        @foreach ($posts as $post)
            <li>
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->description }}</p>
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" width="200">
                @endif   
            
            <!-- Comment Form -->
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="text" class="form-control" placeholder="Add a comment">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Comment</button>
                </form>
            </li>
        @endforeach
        
        
        @foreach($posts as $post)
            <div class="post">
                <p>{{ $post->title }}</p>
                <p>{{ $post->content }}</p>
                @if(auth()->user()->isAdmin())
                    {{-- Code for admin --}}
                @endif

            </div>
        @endforeach


        
        @foreach($comments as $comment)
            <div class="comment">
                <p>{{ $comment->body }}</p>
                @if(auth()->user()->isAdmin())
                    @include('comment.delete', ['comment' => $comment])
                @endif
            </div>
        @endforeach 

        
    </ul>
</div>
@endsection