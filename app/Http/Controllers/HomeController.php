<?php

namespace App\Http\Controllers;
use App\Models\Post;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    

    /**
     * Show the application dashboard.
    
     */
    public function index()
    {
        $posts = Post::all();

        // Pass the post data to the view for rendering
        return view('home', compact('posts'));
    }
}
