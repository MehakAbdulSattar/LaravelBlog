<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;


use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Validate the request data
        $request->validate([
            'post_id' => 'required',
            'text' => 'required|max:255',
        ]);

        // Create a new comment
        $comment = new Comment([
            'text' => $request->input('text'),
            'user_id' => auth()->user()->id,
        ]);

        // Associate the comment with the post and save it
        $comment->post_id = $request->input('post_id'); 
        $comment->save();

        // Redirect back to the post index or wherever you prefer
        return redirect()->route('post.index')->with('success', 'Comment added successfully.');
    }

    public function destroy(Comment $comment)
    {
        // Check if the user is an admin
        if (auth()->use()->isAdmin()) {
            $comment->delete();
            return redirect('/posts')->with('success', 'Comment deleted successfully.');
        } else {
            return redirect('/posts')->with('error', 'Access Denied. You are not an admin.');
        }
    }

    public function index()
    {
        $comments = Comment::all();

        return view('comments.index', compact('comments'));
    }
    public function storeComment(Request $request)
    {
        Comment::create([
            'post_id' => $request->post_id,
            'guest_name' => $request->guest_name,
            'body' => $request->body,
        ]);

        return back()->with('success', 'Comment submitted successfully.');
    }



}



