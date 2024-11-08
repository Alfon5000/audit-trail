<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public function index()
    {
        Gate::authorize('view', new Permission());

        return Inertia::render('Permissions/Index', [
            'permissions' => PermissionResource::collection(Permission::all()),
        ]);
    }

    public function create()
    {
        Gate::authorize('create', new Permission());

        return Inertia::render('Permissions/Create');
    }

    public function store(PermissionRequest $request)
    {
        Gate::authorize('create', new Permission());
        $validated = $request->validated();
        $validated['guard_name'] = 'web';
        Permission::create($validated);
        Session::flash('message', 'Permission created successfully');
        return Redirect::route('permissions.index');
    }

    public function edit(Permission $permission)
    {
        Gate::authorize('edit', $permission);

        return Inertia::render('Permissions/Edit', [
            'permission' => new PermissionResource($permission),
        ]);
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        Gate::authorize('edit', $permission);
        $permission->update($request->validated());
        Session::flash('message', 'Permission updated successfully');
        return Redirect::route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        Gate::authorize('delete', $permission);
        $permission->delete();
        Session::flash('message', 'Permission deleted successfully');
        return Redirect::route('permissions.index');
    }
}
