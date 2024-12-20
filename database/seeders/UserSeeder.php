<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@exmple.com',
            'password' => Hash::make('password'), // Pastikan mengganti password ini
            'role' => 'admin', // Jika ada kolom role
        ]);

        User::create([
            'name' => 'user 1',
            'email' => 'user1@example.com',
            'password' => Hash::make('password'), // Pastikan mengganti password ini
            'role' => 'user', // Jika ada kolom role
        ]);

        User::create([
            'name' => 'user 2',
            'email' => 'use2@example.com',
            'password' => Hash::make('password'), // Pastikan mengganti password ini
            'role' => 'user', // Jika ada kolom role
        ]);


        User::create([
            'name' => 'user 3',
            'email' => 'user3@example.com',
            'password' => Hash::make('password'), // Pastikan mengganti password ini
            'role' => 'user', // Jika ada kolom role
        ]);


    }
}
