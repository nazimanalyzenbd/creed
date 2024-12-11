<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\TBusinessSubCategory;

class TBusinessSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tBusinessSubCategory = TBusinessSubCategory::insert([
            [
                'category_id' => '1', 
                'name' => 'SubCat1', 
                'created_by' => '1',
            ],
            [
                'category_id' => '1', 
                'name' => 'SubCat2',
                'created_by' => '1',
            ],
            [
                'category_id' => '4', 
                'name' => 'Coffee',
                'created_by' => '1',
            ],
            [
                'category_id' => '4', 
                'name' => 'Burger',
                'created_by' => '1',
            ],
            [
                'category_id' => '4', 
                'name' => 'Pizza',
                'created_by' => '1',
            ],
        ]);
    }
}
