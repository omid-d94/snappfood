<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RestaurantCategory>
 */
class RestaurantCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()
            ->randomElement(["kebab", "local", "fastfood", "iranian", "italian"]);

        return [
            "name" => $name,
            "slug" => Str::slug($name),
            "image_path" => "images/categories/foods/" . Str::random(40) . ".jpg",
        ];
    }
}
