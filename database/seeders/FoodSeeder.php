<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\FoodCategoryRestaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Food::factory(100)->create();
        $foods[] = Food::create([
            "title" => "جوجه کباب",
            "raw_material" => "مرغ تازه زعفرانی، ادویه مخصوص، برنج ایرانی، گوجه فرنگی",
            "price" => 120000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(1, 10),
            "food_category" => 5,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "کباب کوبیده مخصوص",
            "raw_material" => "گوشت گوسفندی و گوساله، ادویه مخصوص، برنج ایرانی، گوجه فرنگی، سماق",
            "price" => 130000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(1, 3),
            "food_category" => 5,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "کباب برگ مخصوص",
            "raw_material" => "گوشت گوسفندی و گوساله، ادویه مخصوص، برنج ایرانی، گوجه فرنگی، سماق",
            "price" => 150000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(1, 3),
            "food_category" => 5,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "پپسی",
            "raw_material" => "نوشابه پپسی",
            "price" => 15000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(1, 3),
            "food_category" => 2,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "پپسی",
            "raw_material" => "نوشابه پپسی",
            "price" => 15000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(8, 10),
            "food_category" => 2,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "فانتا",
            "raw_material" => "نوشابه فانتا",
            "price" => 15000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(1, 3),
            "food_category" => 2,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "فانتا",
            "raw_material" => "نوشابه فانتا",
            "price" => 15000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(8, 10),
            "food_category" => 2,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "دوغ آبعلی",
            "raw_material" => "شیر تازه",
            "price" => 13000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(1, 3),
            "food_category" => 2,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "خورشت قرمه سبزی",
            "raw_material" => "سبزی تازه، برنج ایرانی، حبوبات مرغوب",
            "price" => 55000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(4, 6),
            "food_category" => 6,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "خورشت قیمه",
            "raw_material" => "سیب زمینی سرخ شده، برنج ایرانی، حبوبات مرغوب، لیمو عمانی",
            "price" => 60000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(4, 6),
            "food_category" => 6,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "عدس پلو با گوشت چرخ کرده",
            "raw_material" => "عدس مرغوب پلویی، برنج ایرانی، گوشت چرخ کرده تازه، کشمش ",
            "price" => 53000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(4, 6),
            "food_category" => 6,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "پیتزا مخلوط ویژه",
            "raw_material" => "ژامبون مرغ90%، کوکتل پنیری، قارچ، پنیر پیتزا، نان مخصوص",
            "price" => 120000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(8, 10),
            "food_category" => 3,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "پیتزا ایتالیایی",
            "raw_material" => "ژامبون مرغ90%، گوجه فرنگی، ذرت، قارچ، پنیر پیتزا، نان مخصوص",
            "price" => 130000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(8, 10),
            "food_category" => 3,
            "discount_id" => null
        ]);

        $foods[] = Food::create([
            "title" => "ساندویچ ویژه",
            "raw_material" => "گوشت چرخ کرده، گوجه فرنگی، خیارشور، قارچ، فیله مرغ، نان فرانسوی",
            "price" => 125000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(8, 10),
            "food_category" => 3,
            "discount_id" => null
        ]);
        foreach ($foods as $food) {
            FoodCategoryRestaurant::create([
                "food_category_id" => $food->food_category,
                "restaurant_id" => $food->restaurant_id,
            ]);
        }
    }
}
