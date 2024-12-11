<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\TAdminAffiliation;

class TAffiliationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tAdminAffiliation = TAdminAffiliation::insert([
            [
                'name' => 'AffKey1', 
                'created_by' => '1',
            ],
            [
                'name' => 'AffKey2', 
                'created_by' => '1',
            ],
        ]);
    }
}
