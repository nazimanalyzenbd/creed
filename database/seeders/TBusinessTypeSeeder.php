<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\TBusinessType;

class TBusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tBusinessType = TBusinessType::insert([
            [
                'name' => 'Online (Virtual) Store', 
                'description' => 'You sell products from a virtual store.',
                'created_by' => '1',
            ],
            [
                'name' => 'Local (Physical) Store', 
                'description' => 'You have a physical or retail storefront',
                'created_by' => '1',
            ],
            [
                'name' => 'Service Business', 
                'description' => 'You provide services at customer’s location.',
                'created_by' => '1',
            ],
        ]);
    }
}
