<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('karyawans')->insert([
            [
                'division_id' => 1,
                'name' => 'John Doe',
                'image' => 'john_doe.jpg',
                'phone' => '081234567890',
                'position' => 'Manager'
            ],
            [
                'division_id' => 2,
                'name' => 'Jane Smith',
                'image' => 'jane_smith.jpg',
                'phone' => '081298765432',
                'position' => 'Supervisor'
            ],
            [
                'division_id' => 3,
                'name' => 'Robert Brown',
                'image' => 'robert_brown.jpg',
                'phone' => '081212345678',
                'position' => 'Developer'
            ],
            [
                'division_id' => 4,
                'name' => 'Emily Davis',
                'image' => 'emily_davis.jpg',
                'phone' => '081276543210',
                'position' => 'Designer'
            ],
        ]);
    }
}
