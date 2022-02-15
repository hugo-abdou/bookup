<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = RoleResource::collection(Role::paginate(10));

        return inertia('Roles/Index', [
            "roles" => fn () =>  $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Roles/Create', [
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role, Request $request)
    {

        $role['selectedPermissions'] =  $role->getAllPermissions()->map(fn ($per) => $per->id);
        return inertia('Roles/Edit', [
            "role" => fn () => $role,
            'permissions' => Permission::all()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        $this->middleware(['password.confirm']);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
