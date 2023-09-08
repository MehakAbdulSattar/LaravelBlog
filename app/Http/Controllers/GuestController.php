<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function store(Request $request)
    {
        // Check if the user is logged in
        if (auth()->check()) {
            // Authenticated user
            $user = auth()->user();
        } else {
            // Guest user (assign the "guest" role)
            $user = User::firstOrCreate([
                'name' => $request->guest_name, // You can customize this based on your form input
                // Add other guest user details as needed
            ]);
            $user->assignRole('guest');
        }

        // Create the comment associated with the user
        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => $user->id,
            'body' => $request->body,
        ]);

        return back()->with('success', 'Comment submitted successfully.');
    }
}


