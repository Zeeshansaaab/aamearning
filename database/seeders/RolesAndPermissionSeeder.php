<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['group'=> 'settings', 'name' => 'view_settings', 'guard_name' => 'web'],
            ['group'=> 'settings', 'name' => 'edit_settings', 'guard_name' => 'web'],
            
            //Plans
            ['group'=> 'plans', 'name' => 'view_plans', 'guard_name' => 'web'],
            ['group'=> 'plans', 'name' => 'create_plans', 'guard_name' => 'web'],
            ['group'=> 'plans', 'name' => 'edit_plans', 'guard_name' => 'web'],
            ['group'=> 'plans', 'name' => 'delete_plans', 'guard_name' => 'web'],

            //view_permissions
            ['group'=> 'permissions', 'name' => 'view_permissions', 'guard_name' => 'web'],
            ['group'=> 'permissions', 'name' => 'edit_permissions', 'guard_name' => 'web'],
            
            //Roles
            ['group'=> 'roles', 'name' => 'view_roles', 'guard_name' => 'web'],
            ['group'=> 'roles', 'name' => 'edit_roles', 'guard_name' => 'web'],
            ['group'=> 'roles', 'name' => 'create_roles', 'guard_name' => 'web'],
            ['group'=> 'roles', 'name' => 'delete_roles', 'guard_name' => 'web'],

            //Administrator
            ['group'=> 'administrators', 'name' => 'view_administrators', 'guard_name' => 'web'],
            ['group'=> 'administrators', 'name' => 'edit_administrators', 'guard_name' => 'web'],
            ['group'=> 'administrators', 'name' => 'create_administrators', 'guard_name' => 'web'],
            ['group'=> 'administrators', 'name' => 'delete_administrators', 'guard_name' => 'web'],
            
            //user_bonus
            ['group'=> 'user_bonus', 'name' => 'view_user_bonus', 'guard_name' => 'web'],
            ['group'=> 'user_bonus', 'name' => 'edit_user_bonus', 'guard_name' => 'web'],
            ['group'=> 'user_bonus', 'name' => 'create_user_bonus', 'guard_name' => 'web'],
            ['group'=> 'user_bonus', 'name' => 'delete_user_bonus', 'guard_name' => 'web'],

            //users
            ['group'=> 'users', 'name' => 'view_users', 'guard_name' => 'web'],
            ['group'=> 'users', 'name' => 'edit_users', 'guard_name' => 'web'],
            ['group'=> 'users', 'name' => 'create_users', 'guard_name' => 'web'],
            ['group'=> 'users', 'name' => 'delete_users', 'guard_name' => 'web'],

        ];

        Permission::insert($permissions);

         //Admin
        $admin = Role::updateOrCreate(['name' => 'admin']);
        $adminPermissions = Permission::get();
        $admin->permissions()->sync($adminPermissions);
 
         //staff
        $staff = Role::updateOrCreate(['name' => 'staff']);
        $staffPermissions = Permission::whereNotIn('group', [
            'administrators',
             'settings'
            ])->get();
        $staff->permissions()->sync($staffPermissions);

        $user = Role::updateOrCreate(['name' => 'user']);
         
    }
}
