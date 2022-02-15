<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $this->authorize('show role');
        $roles = RoleResource::collection(Role::paginate(10));

        return inertia('Roles/Index', [
            "roles" => fn () =>  $roles
        ]);
    }
    public function create()
    {
        $this->authorize('create role');
        return inertia('Roles/Create', [
            'permissions' => Permission::all()
        ]);
    }
    public function store(Request $request)
    {
        $this->authorize('create role');
        $data = $request->validate([
            'name' => 'required|string|max:255',
            "permissions.*" =>  'integer',
        ]);
        $role = Role::create(['name' => $data['name']]);
        if (isset($data['permissions'])) {
            $role->permissions()->sync($data['permissions']);
        }
        return redirect()->route('roles.index');
    }
    public function edit(Role $role, Request $request)
    {
        $this->authorize('update role');
        $role['selectedPermissions'] =  $role->getAllPermissions()->map(fn ($per) => $per->id);
        return inertia('Roles/Edit', [
            "role" => fn () => $role,
            'permissions' => Permission::all()
        ]);
    }
    public function update(Request $request, Role $role)
    {
        $this->authorize('update role');
        $data = $request->validate([
            'name' => 'required|string|max:255',
            "selectedPermissions.*" =>  'integer',
        ]);
        $role->update(['name' => $data['name']]);

        if (isset($data['selectedPermissions'])) {
            $role->permissions()->sync($data['selectedPermissions']);
        } else {
            $role->permissions()->detach();
        }
        return back(303);
    }
    public function destroy(Request $request, Role $role)
    {
        $this->authorize('destroy role');
        $this->middleware(['password.confirm']);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
