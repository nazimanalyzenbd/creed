<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\TAdminSubscriptionPlan;

class TSubscriptionplanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tAdminSubscriptionPlan = TAdminSubscriptionPlan::insert([
            [
                'plan_name' => 'Tier1', 
                'country_id' => '1', 
                'monthly_cost' => '14.99', 
                'discount' => '20', 
                'yearly_cost' => '143.90', 
                'created_by' => '1',
            ],
            [
                'plan_name' => 'Tier2', 
                'country_id' => '2', 
                'monthly_cost' => '14.99', 
                'discount' => '20', 
                'yearly_cost' => '143.90', 
                'created_by' => '1',
            ],
        ]);
    }
}
