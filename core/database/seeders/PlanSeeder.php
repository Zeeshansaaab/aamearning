<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Free',
            'user_ref' => 0.012,
            'price'=> 0.00000000
        ]);
        Plan::create([
            'name' => 'Investor',
            'user_ref' => 0.012,
            'price'=> 1.00000000
        ]);
        Plan::create([
            'name' => 'Special',
            'user_ref' => 0.012,
            'price'=> 5.00000000
        ]);
    }
}
