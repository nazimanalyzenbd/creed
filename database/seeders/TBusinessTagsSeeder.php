<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\TBusinessTags;

class TBusinessTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tBusinessTags = TBusinessTags::insert([
            [
                'name' => 'Dry Food', 
                'created_by' => '1',
            ],
            [
                'name' => 'Seeds',
                'created_by' => '1',
            ],
            [
                'name' => 'Others',
                'created_by' => '1',
            ],
        ]);
    }
}
