<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;



class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }


    // app/Http/Controllers/PostController.php

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the image validation rules
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
        Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imagePath,
        ]);

        // Redirect to a success page or return a response
        return redirect()->route('post  .index')->with('success', 'Post created successfully.');
    }
    public function index()
    {
        // Fetch all posts from the database
        $posts = Post::all();

        // Pass the post data to the view for rendering
        return view('post.index', compact('posts'));
    }

    // app/Http/Controllers/PostController.php

    // public function update(Request $request, Post $post)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'title' => 'required|max:255',
    //         'description' => 'required',
    //         // Add validation rules for other attributes here
    //     ]);

    //     // Update the post with the new data
    //     $post->update([
    //         'title' => $request->input('title'),
    //         'description' => $request->input('description'),
    //         // Update other attributes here
    //     ]);

    //     // Redirect to the post's show page or a success page
    //     return redirect()->route('post.show', $post)->with('success', 'Post updated successfully.');
    // }


    // app/Http/Controllers/PostController.php

    public function destroy(Post $post)
    {
        // Check if the user is an admin
        if (auth()->user()->isAdmin()) {
            $post->delete();
            return redirect('/post')->with('success', 'Post deleted successfully.');
        } else {
            return redirect('/post')->with('error', 'Access Denied. You are not an admin.');
        }
    }

}


