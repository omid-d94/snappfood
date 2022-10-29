<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Omid Daryaei",
            "email" => "omid@gmail.com",
            "is_admin" => true,
            "password" => Hash::make(12345678),
            "phone" => +989123456789,
        ]);
        User::factory(10)->create();
    }
}
