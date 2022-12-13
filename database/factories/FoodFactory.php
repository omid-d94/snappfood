<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->realTextBetween(10, 50),
            "raw_material" => $this->faker->realTextBetween(50, 100),
            "price" => rand(10, 150) * 1000,
            "image_path" => "images/foods/" . Str::random(40) . ".jpg",
            "restaurant_id" => rand(1, 10),
            "food_category" => rand(1, 5),
            "discount_id" => $this->faker->randomElement([null, rand(1, 10)]),
        ];
    }
}
