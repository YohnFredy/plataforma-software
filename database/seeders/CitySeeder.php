<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $departments = DB::table('departments')->pluck('id'); // Obtener departamentos existentes

        foreach ($departments as $department_id) {
            foreach (range(1, 5) as $index) {
                DB::table('cities')->insert([
                    'department_id' => $department_id,
                    'name' => $faker->city,
                    'cost' => $faker->randomFloat(2, 5, 50), // Costos entre 5 y 50
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
