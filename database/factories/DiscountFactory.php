<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $number = $this->faker->randomElement([10, 20, 30, 40, 50, 60, 70, 80, 90]);
        return [
            "title" => $this->faker->colorName,
            "factor" => 1 - $number / 100,
            "percent" => $number,
            "code" => Str::random(6),
            "expired_at" => $this->faker->dateTimeBetween("now", "+1years"),
        ];
    }
}
