<!-- resources/views/posts/delete.blade.php -->
<form action="{{ route('posts.destroy', $post) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete Post</button>
</form>
