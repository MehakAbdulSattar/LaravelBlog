<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Fetch all posts from the database
        $posts = Post::all();

        // Return a JSON response
        return PostResource::collection($posts);
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Validate the request
        $request->validate($rules);

        // Handle image upload (if needed)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        } else {
            $imagePath = null;
        }

        // Create a new post
        $post = Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'user_id' => auth()->user()->id,
        ]);

        // Return a JSON response with the newly created post
        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        // ... (similar to your existing update method)

        // Return a JSON response with the updated post
        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->comments()->delete();

        // Delete the post
        $post->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
