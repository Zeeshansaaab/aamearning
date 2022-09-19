<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $admin = User::create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@aamearning.com',
            'password' => Hash::make('12345678'),
            'user_type' => 'admin',
            'email_verified_at' => Carbon::now()
        ]);

        $staff = User::create([
            'firstname' => 'staff',
            'lastname' => 'Staff',
            'username' => 'staff',
            'email' => 'staff@aamearning.com',
            'password' => Hash::make('12345678'),
            'user_type' => 'staff',
            'email_verified_at' => Carbon::now()
        ]);

        $user = User::create([
            'plan_id' => 1,
            'firstname' => 'User',
            'lastname' => 'User',
            'username' => 'user',
            'email' => 'user@aamearning.com',
            'password' => Hash::make('12345678'),
            'user_type' => 'user',
            'email_verified_at' => Carbon::now()
        ]);

    }
}
