<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'name' => 'Yohn Fredy',
            'last_name' => 'Guapacha Hurtado',
            'dni' => 94154629,
            'username' => 'master',
            'email' => 'fredy.guapacha@gmail.com',
            'password' => bcrypt('123'),
        ]);

        
        User::factory(10)->create(); 
        
        $this->call([
            CountrySeeder::class,
            DepartmentSeeder::class,
            CitySeeder::class,
            RegisterRedSeeder::class,
        ]);
    }
}
