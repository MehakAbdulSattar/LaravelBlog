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
            'user_id' => auth()->user()->id,
        ]);

        // Redirect to a success page or return a response
        return redirect()->route('post.index')->with('success', 'Post created successfully.');
    }
    public function index()
    {
        // Fetch all posts from the database
        $posts = Post::all();

        // Pass the post data to the view for rendering
        return view('post.index', compact('posts'));
    }

    // app/Http/Controllers/PostController.php

    public function edit(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        // Redirect to the post's show page or a success page
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {   

        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation rules here
            // Add validation rules for other attributes here
        ]);



        // Update the post data
        $post->title = $request->input('title');
        $post->description = $request->input('description');

        // Handle image upload and storage here
       if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        } else {
            $imagePath = null;
        }

        $post->image=$imagePath;
        // Save the updated post
        $post->save();

        // Redirect to the post's show page or a success page
        return redirect()->route('post.index');

    }


    // app/Http/Controllers/PostController.php

    public function destroy(Post $post)
    {
       $post->comments()->delete();

    // Delete the post
    $post->delete();

    return redirect()->route('post.index');
    }

}


