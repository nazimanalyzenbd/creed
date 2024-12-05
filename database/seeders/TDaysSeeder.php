<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\TDays;

class TDaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tDays = TDays::insert([
            [
                'name' => 'Monday',
                'status' => 1,
            ],
            [
                'name' => 'Tuesday',
                'status' => 1,
            ],
            [
                'name' => 'Wednesday',
                'status' => 1,
            ],
            [
                'name' => 'Thursday',
                'status' => 1, 
            ],
            [
                'name' => 'Friday', 
                'status' => 1,
            ],
            [
                'name' => 'Saturday',
                'status' => 1,
            ],
            [
                'name' => 'Sunday',
                'status' => 0,
            ],
        ]);
    }
}
