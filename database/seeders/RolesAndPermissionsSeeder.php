<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        collect(config('app_permissions'))->map(function ($name) {
            Permission::create(['name' => $name]);
        });
        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'admin']);

        $role->givePermissionTo(Permission::all());


        // $role = Role::create(['name' => 'super-admin']);
    }
}
