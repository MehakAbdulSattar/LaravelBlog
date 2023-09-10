<!-- resources/views/posts/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Post</h2>
    <form method="POST" action="{{ route('post.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Use this line to specify the PUT method -->

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required maxlength="255">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $post->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <!-- Add form fields for other attributes here -->

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection
