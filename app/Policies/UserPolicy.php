<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the authenticated user can view any user models.
     */
    public function viewAny(User $user): bool
    {
        // Only admin can view all users
        return $user->role->role_name === 'admin';
    }

    /**
     * Determine whether the authenticated user can view a specific user model.
     */
    public function view(User $user, User $profileOwner): bool
    {
        // Admin can view anyone, users can only view their own profile
        return $user->role->role_name === 'admin' || $user->user_id === $profileOwner->user_id;
    }

    /**
     * Determine whether the authenticated user can create new user models.
     */
    public function create(User $user): bool
    {
        // Only admin users can create users
        return $user->role->role_name === 'admin';
    }

    /**
     * Determine whether the authenticated user can update the user model.
     */
    public function update(User $user, User $profileOwner): bool
    {
        // Admins can update any user, regular users can only update their own profile
        return $user->role->role_name === 'admin' || $user->user_id === $profileOwner->user_id;
    }

    /**
     * Determine whether the authenticated user can delete the user model.
     */
    public function delete(User $user, User $profileOwner): bool
    {
        // Only admin can delete a user, and not themselves for now , later maybe i give permission of users to delete their accounts
        return $user->role->role_name === 'admin' && $user->user_id !== $profileOwner->user_id;
    }
}
