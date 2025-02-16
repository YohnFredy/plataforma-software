<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = faker::create();
        foreach (range(1, 5) as $index) {
            DB::table('countries')->insert([
                'name' => $faker->country,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
