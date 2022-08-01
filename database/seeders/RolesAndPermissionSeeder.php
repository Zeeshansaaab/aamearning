<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            ['group'=> 'settings', 'name' => 'view settings', 'guard_name' => 'web'],
            ['group'=> 'settings', 'name' => 'edit settings', 'guard_name' => 'web'],
        ];

        Permission::insert($permissions);

         //Admin
        $admin = Role::updateOrCreate(['name' => 'admin']);
        $adminPermissions = Permission::get();
        $admin->permissions()->sync($adminPermissions);
 
         //staff
        $staff = Role::updateOrCreate(['name' => 'staff']);
        $staffPermissions = Permission::whereNotIn('group', [
             'settings'])->get();
        $staff->permissions()->sync($staffPermissions);

        $user = Role::updateOrCreate(['name' => 'user']);
         
    }
}
