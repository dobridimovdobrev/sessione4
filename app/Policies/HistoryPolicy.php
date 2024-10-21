<?php

namespace App\Policies;

use App\Models\History;
use App\Models\User;


class HistoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role->role_name === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, History $history): bool
    {
        return $user->role->role_name === 'admin' || $user->user_id === $history->user_id ;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only admin and authorized users can create history
        return $user->role->role_name === 'admin' || $user->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, History $history): bool
    {
        return $user->role->role_name === 'admin' || $user->user_id === $history->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, History $history): bool
    {
        return $user->role->role_name === 'admin' || $user->user_id === $history->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, History $history): bool
    {
        return $user->role->role_name === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, History $history): bool
    {
        return $user->role->role_name === 'admin';
    }
}
