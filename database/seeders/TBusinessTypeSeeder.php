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
                'name' => 'Online Retail', 
                'created_by' => '1',
            ],
            [
                'name' => 'Local Store', 
                'created_by' => '1',
            ],
            [
                'name' => 'Others', 
                'created_by' => '1',
            ],
        ]);
    }
}
