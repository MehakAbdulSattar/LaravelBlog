<!-- resources/views/comments/create.blade.php -->
<form action="{{ route('comments.store') }}" method="POST">
    @csrf
    <input type="text" name="guest_name" placeholder="Your Name">
    <textarea name="body" placeholder="Your Comment"></textarea>
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <button type="submit">Submit Comment</button>
</form>
