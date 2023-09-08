<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Validate the request data
        $request->validate([
            'text' => 'required|max:255',
        ]);

        // Create a new comment
        $comment = new Comment([
            'text' => $request->input('text'),
        ]);

        // Associate the comment with the post and save it
        $post->comments()->save($comment);

        // Redirect back to the post index or wherever you prefer
        return redirect()->route('post.index')->with('success', 'Comment added successfully.');
    }

    // app/Http/Controllers/CommentController.php

    public function destroy(Comment $comment)
    {
        // Check if the user is an admin
        if (auth()->user()->isAdmin()) {
            $comment->delete();
            return redirect('/posts')->with('success', 'Comment deleted successfully.');
        } else {
            return redirect('/posts')->with('error', 'Access Denied. You are not an admin.');
        }
    }

    public function index()
    {
        $comments = Comment::all(); // Replace with your query to fetch comments

        return view('comments.index', compact('comments'));
    }


}



