<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\TGenericCode;

class TGenericCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tGenericCode = TGenericCode::insert([
            [
                'source_table_name' => 't_admin_users', 
                'field_name' => 'status',
                'description' => '1=Active, 0=Inactive',
            ],
            [
                'source_table_name' => 'users', 
                'field_name' => 'account_type',
                'description' => 'G=General, B=Business',
            ],
            [
                'source_table_name' => 't_business_owner_infos', 
                'field_name' => 'status',
                'description' => '1=Business Owner Info Complete, 2=Business Info Complete, 3=Payment Failed, 4=Payment Success',
            ],
            [
                'source_table_name' => 't_businesses', 
                'field_name' => 'lat,long',
                'description' => 'lat = Latitude, log = Longitude',
            ],
        ]);
    }
}
