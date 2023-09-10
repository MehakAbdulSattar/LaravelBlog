<!-- resources/views/includes/previous_comments.blade.php -->
<ul>
    @foreach ($post->comments as $comment)
    <li>
        @php
            $user = App\Models\User::find($comment->user_id);
        @endphp
        @if ($user)
        <strong>{{ $user->name }}:</strong>
        @endif
        {{ $comment->text }}
    </li>
    @endforeach
</ul>
