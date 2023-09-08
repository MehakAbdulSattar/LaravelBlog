<!-- resources/views/comments/delete.blade.php -->
<form action="{{ route('comments.destroy', $comment) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete Comment</button>
</form>
