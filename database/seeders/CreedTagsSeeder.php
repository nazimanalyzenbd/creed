<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\TCreedTags;

class CreedTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tCreedTags = TCreedTags::insert([

            ['name' => 'Muslim Owned', 'created_by' => '1'],
            ['name' => 'Muslim Operated', 'created_by' => '1'],
            ['name' => 'Serving Muslim Community', 'created_by' => '1']

        ]);
    }
}
