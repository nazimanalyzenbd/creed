<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\TBusinessCategory;

class TBusinessCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tBusinessCategory = TBusinessCategory::insert([
            [
                'name' => 'Law Firm', 
                'created_by' => '1',
            ],
            [
                'name' => 'Lawyer', 
                'created_by' => '1',
            ],
            [
                'name' => 'Law Suite', 
                'created_by' => '1',
            ],
            [
                'name' => 'Restaurant', 
                'created_by' => '1',
            ],
            [
                'name' => 'Law', 
                'created_by' => '1',
            ],
        ]);
    }
}
