<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Discount::factory(10)->create();
        Discount::create([
            "title" => "Gold",
            "percent" => 40,
            "factor" => 0.6,
            "code" => Str::random(6),
            "expired_at" => now()->addMonths(rand(1, 6)),
        ]);

        Discount::create([
            "title" => "silver",
            "percent" => 30,
            "factor" => 0.7,
            "code" => Str::random(6),
            "expired_at" => now()->addMonths(rand(1, 6)),
        ]);

        Discount::create([
            "title" => "bronze",
            "percent" => 20,
            "factor" => 0.8,
            "code" => Str::random(6),
            "expired_at" => now()->addMonths(rand(1, 6)),
        ]);
    }
}
