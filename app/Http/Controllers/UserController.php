<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('view', User::class);

        return Inertia::render('Users/Index', [
            'users' => UserResource::collection(User::all()),
        ]);
    }

    public function create()
    {
        Gate::authorize('create', User::class);

        return Inertia::render('Users/Create', [
            'roles' => RoleResource::collection(Role::all()),
            'permissions' => PermissionResource::collection(Permission::all()),
        ]);
    }

    public function store(UserRequest $request)
    {
        Gate::authorize('create', User::class);
        $user = User::create($request->validated());
        $user->assignRole($request->input('roles.*.name'));
        $user->givePermissionTo($request->input('permissions.*.name'));
        Session::flash('message', 'User created successfully');

        return Redirect::route('users.index');
    }

    public function edit(User $user)
    {
        Gate::authorize('edit', $user);

        return Inertia::render('Users/Edit', [
            'user' => new UserResource($user),
            'roles' => RoleResource::collection(Role::all()),
            'permissions' => PermissionResource::collection(Permission::all()),
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        Gate::authorize('edit', $user);
        $user->update($request->validated());
        $user->syncRoles($request->input('roles.*.name'));
        $user->syncPermissions($request->input('permissions.*.name'));
        Session::flash('message', 'User updated successfully');

        return Redirect::route('users.index');
    }

    function destroy(User $user)
    {
        Gate::authorize('delete', $user);
        $user->delete();
        Session::flash('message', 'User deleted successfully');

        return Redirect::route('users.index');
    }
}
