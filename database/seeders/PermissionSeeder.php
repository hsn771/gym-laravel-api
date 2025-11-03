<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Clean up the existing permissions
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('model_has_permissions')->delete();
        \DB::table('role_has_permissions')->delete();
        Permission::query()->delete();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create permissions for users
        Permission::firstOrCreate(['name' => 'view users', 'guard_name' => 'web'], ['head' => 'Users']);
        Permission::firstOrCreate(['name' => 'create users', 'guard_name' => 'web'], ['head' => 'Users']);
        Permission::firstOrCreate(['name' => 'edit users', 'guard_name' => 'web'], ['head' => 'Users']);
        Permission::firstOrCreate(['name' => 'delete users', 'guard_name' => 'web'], ['head' => 'Users']);

        Permission::firstOrCreate(['name' => 'assign roles', 'guard_name' => 'web'], ['head' => 'Roles']);

        // Create permissions for river points
        Permission::firstOrCreate(['name' => 'view river-points', 'guard_name' => 'web'], ['head' => 'River Points']);
        Permission::firstOrCreate(['name' => 'create river-points', 'guard_name' => 'web'], ['head' => 'River Points']);
        Permission::firstOrCreate(['name' => 'edit river-points', 'guard_name' => 'web'], ['head' => 'River Points']);
        Permission::firstOrCreate(['name' => 'delete river-points', 'guard_name' => 'web'], ['head' => 'River Points']);

        // Create permissions for tenders
        Permission::firstOrCreate(['name' => 'view tenders', 'guard_name' => 'web'], ['head' => 'Tenders']);
        Permission::firstOrCreate(['name' => 'create tenders', 'guard_name' => 'web'], ['head' => 'Tenders']);
        Permission::firstOrCreate(['name' => 'edit tenders', 'guard_name' => 'web'], ['head' => 'Tenders']);
        Permission::firstOrCreate(['name' => 'delete tenders', 'guard_name' => 'web'], ['head' => 'Tenders']);

        // Create permissions for sand types
        Permission::firstOrCreate(['name' => 'view sand-types', 'guard_name' => 'web'], ['head' => 'Sand Types']);
        Permission::firstOrCreate(['name' => 'create sand-types', 'guard_name' => 'web'], ['head' => 'Sand Types']);
        Permission::firstOrCreate(['name' => 'edit sand-types', 'guard_name' => 'web'], ['head' => 'Sand Types']);
        Permission::firstOrCreate(['name' => 'delete sand-types', 'guard_name' => 'web'], ['head' => 'Sand Types']);

        // Create permissions for tender owners
        Permission::firstOrCreate(['name' => 'view tender-owners', 'guard_name' => 'web'], ['head' => 'Tender Owners']);
        Permission::firstOrCreate(['name' => 'create tender-owners', 'guard_name' => 'web'], ['head' => 'Tender Owners']);
        Permission::firstOrCreate(['name' => 'edit tender-owners', 'guard_name' => 'web'], ['head' => 'Tender Owners']);
        Permission::firstOrCreate(['name' => 'delete tender-owners', 'guard_name' => 'web'], ['head' => 'Tender Owners']);

        // Create permissions for vehicles
        Permission::firstOrCreate(['name' => 'view vehicles', 'guard_name' => 'web'], ['head' => 'Vehicles']);
        Permission::firstOrCreate(['name' => 'create vehicles', 'guard_name' => 'web'], ['head' => 'Vehicles']);
        Permission::firstOrCreate(['name' => 'edit vehicles', 'guard_name' => 'web'], ['head' => 'Vehicles']);
        Permission::firstOrCreate(['name' => 'delete vehicles', 'guard_name' => 'web'], ['head' => 'Vehicles']);

        // Create permissions for workers
        Permission::firstOrCreate(['name' => 'view workers', 'guard_name' => 'web'], ['head' => 'Workers']);
        Permission::firstOrCreate(['name' => 'create workers', 'guard_name' => 'web'], ['head' => 'Workers']);
        Permission::firstOrCreate(['name' => 'edit workers', 'guard_name' => 'web'], ['head' => 'Workers']);
        Permission::firstOrCreate(['name' => 'delete workers', 'guard_name' => 'web'], ['head' => 'Workers']);

        // Create permissions for sale points
        Permission::firstOrCreate(['name' => 'view sale-points', 'guard_name' => 'web'], ['head' => 'Sale Points']);
        Permission::firstOrCreate(['name' => 'create sale-points', 'guard_name' => 'web'], ['head' => 'Sale Points']);
        Permission::firstOrCreate(['name' => 'edit sale-points', 'guard_name' => 'web'], ['head' => 'Sale Points']);
        Permission::firstOrCreate(['name' => 'delete sale-points', 'guard_name' => 'web'], ['head' => 'Sale Points']);

        // Create permissions for transport rates
        Permission::firstOrCreate(['name' => 'view transport-rates', 'guard_name' => 'web'], ['head' => 'Transport Rates']);
        Permission::firstOrCreate(['name' => 'create transport-rates', 'guard_name' => 'web'], ['head' => 'Transport Rates']);
        Permission::firstOrCreate(['name' => 'edit transport-rates', 'guard_name' => 'web'], ['head' => 'Transport Rates']);
        Permission::firstOrCreate(['name' => 'delete transport-rates', 'guard_name' => 'web'], ['head' => 'Transport Rates']);

        // Create permissions for buyers
        Permission::firstOrCreate(['name' => 'view buyers', 'guard_name' => 'web'], ['head' => 'Buyers']);
        Permission::firstOrCreate(['name' => 'create buyers', 'guard_name' => 'web'], ['head' => 'Buyers']);
        Permission::firstOrCreate(['name' => 'edit buyers', 'guard_name' => 'web'], ['head' => 'Buyers']);
        Permission::firstOrCreate(['name' => 'delete buyers', 'guard_name' => 'web'], ['head' => 'Buyers']);

        $permissions = Permission::all();

        // Remove all permissions for all roles
        Role::all()->each(function ($role) {
            $role->syncPermissions([]);
        });

        // Create super-admin role and assign all permissions
        $role = Role::firstOrCreate(['name' => 'super-admin']);
        $role->givePermissionTo($permissions);
    }
}
