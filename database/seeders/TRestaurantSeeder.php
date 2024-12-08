<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\TAdminRestaurant;

class TRestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tAdminRestaurant = TAdminRestaurant::insert([
            [
                'name' => '100% Halal', 
                'created_by' => '1',
            ],
            [
                'name' => '100% Handcut Halal', 
                'created_by' => '1',
            ],
            [
                'name' => 'No Alcohol Served', 
                'created_by' => '1',
            ],
        ]);
    }
}
