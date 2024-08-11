<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('password'),
        // ]);
        $this->call(UserSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(KaryawanSeeder::class);
    }
}
