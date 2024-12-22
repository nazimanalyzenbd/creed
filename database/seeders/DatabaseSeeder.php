<?php

namespace Database\Seeders;

use App\Models\User;
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
            TBusinessTypeSeeder::class,
            TBusinessCategorySeeder::class,
            TBusinessSubCategorySeeder::class,
            TBusinessTagsSeeder::class,
            // TSubscriptionplanSeeder::class,
            TAffiliationSeeder::class,
            TAboutUsSeeder::class,
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
