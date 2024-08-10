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
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'phone' => '1234567890',
            'email' => 'admin@admin',
            'password' => Hash::make('admin'),
            'email_verified_at' => now(),
        ]);
    }
}
