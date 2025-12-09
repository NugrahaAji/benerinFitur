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
            'email_verified_at' => now(),
        ]);
    }
}
