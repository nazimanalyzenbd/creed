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
                'name' => 'Technology', 
                'description' => 'Technology Consultant/Computers/Phones.', 
                'created_by' => '1',
            ],
            [
                'name' => 'Medical', 
                'description' => 'Doctor/Dentist/Surgeon/Mental Health/Medical Services/Health & Well Being Facility.', 
                'created_by' => '1',
            ],
            [
                'name' => 'Legal', 
                'description' => 'Lawyer/Law-Firm/Legal Expert/Legal Consultant.', 
                'created_by' => '1',
            ],
            [
                'name' => 'Event Planning', 
                'description' => 'Event Planning description', 
                'created_by' => '1',
            ],
            [
                'name' => 'Halal Restaurant', 
                'description' => 'Halal Restaurant description', 
                'created_by' => '1',
            ],
        ]);
    }
}
