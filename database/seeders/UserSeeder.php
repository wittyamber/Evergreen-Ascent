<?php

namespace Database\Seeders;

use App\Models\User; // <-- Import the User model
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the Administrator User
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@evergreen.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(), // <-- ADD THIS LINE
        ]);

        // Create the HR User
        User::create([
            'first_name' => 'David',
            'last_name' => 'HR',
            'email' => 'hr@evergreen.com',
            'password' => Hash::make('password'),
            'role' => 'hr',
            'email_verified_at' => now(), // <-- AND ADD THIS LINE
        ]);
    }
}
