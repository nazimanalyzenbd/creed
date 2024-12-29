<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\TAppTermsAndConditions;

class TAppTermsAndConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tAppTermsAndConditions = TAppTermsAndConditions::insert([
            [
                'page_1_heading' => json_encode(['Create Business Profile','Add business listing details','Select your plan']), 
                'page_2_title' => 'To begin, open a business account and accept the business terms and conditions.', 
                'page_2_heading' => 'Business profile allows you to:', 
                'page_2_description' => 'list, manage, create promotions, and provides you with business insights.', 
                'created_by' => '1',
            ],
        ]);
    }
}
