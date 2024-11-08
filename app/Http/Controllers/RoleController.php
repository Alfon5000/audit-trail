<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        Gate::authorize('view', new Role());

        return Inertia::render('Roles/Index', [
            'roles' => RoleResource::collection(Role::all()),
        ]);
    }

    public function create()
    {
        Gate::authorize('create', new Role());

        return Inertia::render('Roles/Create', [
            'permissions' => PermissionResource::collection(Permission::all()),
        ]);
    }

    public function store(RoleRequest $request)
    {
        Gate::authorize('create', new Role());

        $validated = $request->validated();
        $validated['guard_name'] = 'web';
        $role = Role::create($validated);
        $role->givePermissionTo($request->input('permissions.*.name'));
        Session::flash('message', 'Role created successfully');
        return Redirect::route('roles.index');
    }

    public function edit(Role $role)
    {
        Gate::authorize('edit', $role);

        return Inertia::render('Roles/Edit', [
            'role' => new RoleResource($role),
            'permissions' => PermissionResource::collection(Permission::all()),
        ]);
    }

    public function update(RoleRequest $request, Role $role)
    {
        Gate::authorize('edit', $role);
        $role->update($request->validated());
        $role->syncPermissions($request->input('permissions.*.name'));
        Session::flash('message', 'Role updated successfully');

        return Redirect::route('roles.index');
    }

    public function destroy(Role $role)
    {
        Gate::authorize('delete', $role);
        $role->delete();
        Session::flash('message', 'Role deleted successfully');

        return Redirect::route('roles.index');
    }
}
