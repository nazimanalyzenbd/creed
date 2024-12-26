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
                'name' => 'Information Technology Services', 
                'description' => 'IT Related Service',
                'created_by' => '1',
            ],
            [
                'name' => 'Dentist Dental Surgeon', 
                'description' => 'Dental Related Service',
                'created_by' => '1',
            ],
            [
                'name' => 'Muslim Legal Services Family Law', 
                'description' => 'Family Law Related Legal Service',
                'created_by' => '1',
            ],
            [
                'name' => 'Event planning party planning', 
                'description' => 'Event Planning Related Service',
                'created_by' => '1',
            ],
            [
                'name' => 'Halal Yemeni Restaurant', 
                'description' => 'Restaurant Related Service',
                'created_by' => '1',
            ],
            [
                'name' => 'Halal italian restaurant', 
                'description' => 'Italian Restaurant Related Service',
                'created_by' => '1',
            ],
            [
                'name' => 'Online Retail', 
                'description' => 'Online Retail Description',
                'created_by' => '1',
            ],
            [
                'name' => 'Local Store', 
                'description' => 'Local Store Description',
                'created_by' => '1',
            ],
            [
                'name' => 'Others', 
                'description' => 'Others Description',
                'created_by' => '1',
            ],
        ]);
    }
}
