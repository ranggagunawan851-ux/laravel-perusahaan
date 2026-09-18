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
        // Membuat akun Admin utama
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('password123'), // Password untuk login
                'role'     => 'admin',
            ]
        );

        // (Opsional) Membuat akun Penulis/Author tambahan
        User::firstOrCreate(
            ['email' => 'penulis@gmail.com'],
            [
                'name'     => 'Penulis Konten',
                'password' => Hash::make('password123'),
                'role'     => 'author',
            ]
        );
    }
}
