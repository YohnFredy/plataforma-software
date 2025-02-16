<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $countries = DB::table('countries')->pluck('id'); // Obtener países existentes

        foreach ($countries as $country_id) {
            foreach (range(1, 4) as $index) {
                DB::table('departments')->insert([
                    'country_id' => $country_id,
                    'name' => $faker->state,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
