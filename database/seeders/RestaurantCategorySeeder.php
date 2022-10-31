<?php

namespace Database\Seeders;

use App\Models\RestaurantCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RestaurantCategory::create(["name" => "Iranian"]);
        RestaurantCategory::create(["name" => "FastFood"]);
        RestaurantCategory::create(["name" => "Kebab"]);
        RestaurantCategory::create(["name" => "Pizza"]);
        RestaurantCategory::create(["name" => "Burger"]);
        RestaurantCategory::create(["name" => "Sandwich"]);
        RestaurantCategory::create(["name" => "Fried"]);
        RestaurantCategory::create(["name" => "Pasta"]);
        RestaurantCategory::create(["name" => "SeaFood"]);
        RestaurantCategory::create(["name" => "International"]);
    }
}
