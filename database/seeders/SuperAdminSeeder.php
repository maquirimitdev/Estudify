<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create superadmin user
        User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@estudify.com',
            'username' => 'superadmin',
            'user_type' => 'SUP',
            'password' => Hash::make('Estudifyadmin2024!'),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // // Create admin user
        // User::create([
        //     'name' => 'Administrator',
        //     'email' => 'admin@estudify.com',
        //     'username' => 'admin',
        //     'user_type' => 'ADM',
        //     'password' => Hash::make('password123'),
        //     'is_active' => true,
        // ]);

        // // Optional: Create sample teacher
        // User::create([
        //     'name' => 'John Teacher',
        //     'email' => 'john@estudify.com',
        //     'username' => 'john_teacher',
        //     'user_type' => 'TCH',
        //     'password' => Hash::make('password123'),
        //     'is_active' => true,
        // ]);

        // // Optional: Create sample student
        // User::create([
        //     'name' => 'Jane Student',
        //     'email' => 'jane@estudify.com',
        //     'username' => 'jane_student',
        //     'user_type' => 'STU',
        //     'password' => Hash::make('password123'),
        //     'is_active' => true,
        // ]);

        // // Optional: Create sample parent
        // User::create([
        //     'name' => 'Parent One',
        //     'email' => 'parent@estudify.com',
        //     'username' => 'parent_one',
        //     'user_type' => 'PAR',
        //     'password' => Hash::make('password123'),
        //     'is_active' => true,
        // ]);
    }
}
