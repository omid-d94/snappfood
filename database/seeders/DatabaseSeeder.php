<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FoodCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            SellerSeeder::class,
            UserSeeder::class,
            AddressSeeder::class,
            AddressUserSeeder::class,
            FoodCategorySeeder::class,
            RestaurantCategorySeeder::class,
            RestaurantSeeder::class,
            DiscountSeeder::class,
            FoodSeeder::class,
//            CartSeeder::class,
//            CartFoodSeeder::class,
            WorkingTimeSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
