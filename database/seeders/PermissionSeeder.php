<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        Permission::create(['name' => 'edit point']);
        Permission::create(['name' => 'add point']);
        Permission::create(['name' => 'edit toilet']);
        Permission::create(['name' => 'add toilet']);
        Permission::create(['name' => 'show review']);

        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'add category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('edit articles');
        $role1->givePermissionTo('delete articles');
        $role1->givePermissionTo('publish articles');

        $role2 = Role::create(['name' => 'Super-Admin']);
        $role2->givePermissionTo('publish articles');
        $role2->givePermissionTo('unpublish articles');
        $role2->givePermissionTo('edit articles');
        $role2->givePermissionTo('delete articles');
        $role2->givePermissionTo('edit point');
        $role2->givePermissionTo('add point');
        $role2->givePermissionTo('edit toilet');
        $role2->givePermissionTo('add toilet');
        $role2->givePermissionTo('show review');
        $role2->givePermissionTo('edit user');
        $role2->givePermissionTo('add user');
        $role2->givePermissionTo('delete user');
        $role2->givePermissionTo('add category');
        $role2->givePermissionTo('edit category');
        $role2->givePermissionTo('delete category');

        $role3 = Role::create(['name' => 'user-point']);
        $role3->givePermissionTo('edit point');
        $role3->givePermissionTo('add point');
        $role3->givePermissionTo('edit toilet');
        $role3->givePermissionTo('add toilet');
        $role3->givePermissionTo('show review');

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@konsultanvisa.com',
            'password' => Hash::make('eco')
        ]);
        $user->assignRole($role2);
    }
}
