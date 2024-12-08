<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TAdminUser;
use App\Models\TGenericCode;
use App\Models\Admin\TCreedTags;
use App\Models\Admin\TDays;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            TGenericCodeSeeder::class,
            CreedTagsSeeder::class,
            TDaysSeeder::class,
            TRestaurantSeeder::class,
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
