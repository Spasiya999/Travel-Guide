<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'manage users',
            'manage roles',
            'manage permissions',
            'manage system settings',
            'manage components',
            'create packages',
            'edit packages',
            'delete packages',
            'publish packages',
            'view bookings',
            'manage testimonials',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $user = Role::firstOrCreate(['name' => 'User']);

        $superAdmin->syncPermissions(Permission::all());
        $admin->syncPermissions([
            'create packages', 'edit packages', 'delete packages',
            'publish packages', 'view bookings', 'manage testimonials'
        ]);
        $user->syncPermissions([]); // Regular user, no backend permissions
    }
}
