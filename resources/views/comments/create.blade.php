<!-- resources/views/includes/comment_form.blade.php -->
<form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <div class="form-group">
        <input type="text" name="text" class="form-control" placeholder="Add a comment">
    </div>
    <button type="submit" class="btn btn-primary">Add Comment</button>
</form>
