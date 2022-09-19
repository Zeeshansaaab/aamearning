<?php

namespace Database\Seeders;

use stdClass;
use App\Models\User;
use App\Models\BonusPlan;
use Illuminate\Database\Seeder;

class BonusPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            ['name' => 'Total Share Links', 'value' => '200', 'type' => 'number', 'key' => 'total_share_links'],
            ['name' => 'Total Referrals', 'value' => '100', 'type' => 'number', 'key' => 'total_referrals'],
            ['name' => 'Total Unlimited Earning links', 'value' => '300', 'type' => 'number', 'key' => 'total_unlimited_earning']
        ];
        $userBonus = BonusPlan::create([
            'name' => "Get Bonus",
            'value' => json_encode($values),
            'amount' => 2,
            'plan_id' => 1,
            'status' => true
        ]);

        User::find(3)->userBonus()->create([
            'bonus_plan_id' => $userBonus->id, 
        ]);
        
    }
}
