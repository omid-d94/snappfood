<?php

namespace Database\Seeders;

use App\Models\RestaurantCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RestaurantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        RestaurantCategory::factory(5)->create();
        RestaurantCategory::create([
            "name" => "کبابی",
            "slug" => "kebab",
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ]);

        RestaurantCategory::create([
            "name" => "فست فود",
            "slug" => "fast-food",
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ]);

        RestaurantCategory::create([
            "name" => "ایرانی",
            "slug" => "iranian",
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ]);

        RestaurantCategory::create([
            "name" => "ایتالیایی",
            "slug" => "italian",
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ]);

        RestaurantCategory::create([
            "name" => "محلی",
            "slug" => "local",
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ]);

    }
}
