<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => Str::title($this->faker->title),
            "logo" => "images/restaurants/" . Str::random(40) . ".jpg",
            "phone" => "+21" . $this->faker->numerify("########"),
            "address" => $this->faker->address,
            "latitude" => $this->faker->latitude(35.7219000, 35.7219999),
            "longitude" => $this->faker->longitude(51.3347000, 51.3347999),
            "type" => rand(1, 5),
            "seller_id" => $this->faker->unique()->randomElement(range(1, 10)),
            "status" => true,
            "account" => $this->faker->numerify("############"),
            "send_cost" => $this->faker->randomElement([0, 5000, 10000, 15000]),
        ];
    }
}
