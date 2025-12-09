<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sipanda.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        echo "Admin user berhasil dibuat!\n";
        echo "Email: admin@sipanda.com\n";
        echo "Password: password\n";
        echo "PENTING: Segera ganti password setelah login!\n";
    }
}
