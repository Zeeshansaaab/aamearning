<?php

namespace Database\Seeders;

// use Illuminate\Databa

use App\Models\BonusPlan;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesAndPermissionSeeder::class,
            PlanSeeder::class,
            UserTableSeeder::class,
            GeneralSettingsSeeder::class,
        ]);

        \App\Models\User::factory(200)->create();

        //Admin Roles
        $admins = User::where('user_type', 'admin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $admins->assignRole('admin');
        // $adminRole->users()->sync($admins->pluck('id'));
        //Staff Role
        $staffs = User::where('user_type', 'staff')->get();
        $staffRole = Role::where('name', 'staff')->first();
        $staffRole->users()->sync($staffs->pluck('id'));
        //User Role
        $users = User::where('user_type', 'user')->get();
        $userRole = Role::where('name', 'user')->first();
        $userRole->users()->sync($users->pluck('id'));
        
        // $plans = Plan::all()->pluck('id')->toArray();
        // foreach($users as $user){
        //     $user->plan()->attach(Arr::random($plans));   
        // }     
        $this->call([
            ReferralsTableSeeder::class,
            BonusPlanSeeder::class,
            GatewayTableSeeder::class,
        ]);

    }
}
