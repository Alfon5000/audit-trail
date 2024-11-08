<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user): bool
    {
        return $user->hasPermissionTo('view users');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create user');
    }

    public function edit(User $user): bool
    {
        return $user->hasPermissionTo('edit user');
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo('delete user');
    }
}
