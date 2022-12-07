<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartFood>
 */
class CartFoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "cart_id" => rand(1, 30),
            "food_id" => rand(1, 100),
            "count" => rand(1, 5),
        ];
    }
}
