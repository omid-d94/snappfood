<?php

namespace Database\Seeders;

use App\Models\FoodCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FoodCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        FoodCategory::factory(6)->create();

        FoodCategory::create([
            "title" => "ساندویچ",
            "slug" => Str::slug("sandwich"),
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ]);


        FoodCategory::create([
            "title" => "نوشیدنی",
            "slug" => Str::slug("drink"),
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ]);

        FoodCategory::create([
            "title" => "پیتزا",
            "slug" => Str::slug("pizza"),
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ]);


        FoodCategory::create([
            "title" => "سالاد",
            "slug" => Str::slug("salad"),
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ]);

        FoodCategory::create([
            "title" => "کباب",
            "slug" => Str::slug("kebab"),
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ]);

        FoodCategory::create([
            "title" => "خورشت",
            "slug" => Str::slug("khoresht"),
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ]);
    }
}
