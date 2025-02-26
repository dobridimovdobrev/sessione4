<?php

namespace App\Policies;

use App\Models\TvSerie;
use App\Models\User;


class TvSeriePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role->role_name === 'admin' || $user->role->role_name === 'user';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TvSerie $tvSerie): bool
    {
        return $user->role->role_name === 'admin' || $user->role->role_name === 'user';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->role_name === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TvSerie $tvSerie): bool
    {
        return $user->role->role_name === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TvSerie $tvSerie): bool
    {
        return $user->role->role_name === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TvSerie $tvSerie): bool
    {
        return $user->role->role_name === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TvSerie $tvSerie): bool
    {
        return $user->role->role_name === 'admin';
    }
}
