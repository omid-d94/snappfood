<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodCategory>
 */
class FoodCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->unique()
            ->randomElement(["kebab", "pizza", "sandwich", "stew", "drink", "salad"]);

        return [
            "title" => $title,
            "slug" => Str::slug($title),
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ];
    }
}
