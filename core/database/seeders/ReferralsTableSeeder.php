<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Referral;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReferralsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $referrals = [
            [
                'level' => 1,
                'percent' => '30%',
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level' => 2,
                'percent' => '0.012',
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Referral::insert($referrals);
    }
}
