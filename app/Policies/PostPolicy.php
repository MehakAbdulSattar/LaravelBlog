<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    /**
     * Determine whether the user can view the model.
     */
  
    /**
     * Determine whether the user can create models.
     */


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post)
{
    // Check if the user is the owner or has role 1
    if ($user->id === $post->user_id || $user->role_as === 1)
    {
        return true;
    }
    return false;
}

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post)
    {
        // Check if the user is the owner or has role 1
        return ($user->id === $post->user_id || $user->role_as === 1);
    }


    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        //
    }
}
