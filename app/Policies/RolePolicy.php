<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('view roles');
    }

    public function create(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('create role');
    }

    public function edit(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('edit role');
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('delete role');
    }
}
