<?php

namespace Database\Seeders;

use App\Models\WorkingTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkingTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = array("sat", "sun", "mon", "tue", "wed", "thu", "fri");
        for ($i = 1; $i <= 10; $i++) {
            for ($j = 0; $j < 7; $j++) {
                WorkingTime::create([
                    "restaurant_id" => $i,
                    "day" => $days[$j],
                    "start" => "11:00:00",
                    "end" => "00:00:00",
                ]);
            }
        }
    }
}
