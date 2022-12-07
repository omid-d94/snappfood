<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "address" => $this->faker->address,
            "latitude" => $this->faker->latitude(35.7219000, 35.7219999),
            "longitude" => $this->faker->longitude(51.3347000, 51.3347999),
            "title" => $this->faker->name,
            "default" => false
        ];
    }
}
