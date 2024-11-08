<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermissionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('view permissions');
    }

    public function create(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('create permission');
    }

    public function edit(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('edit permission');
    }

    public function delete(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('delete permission');
    }
}
