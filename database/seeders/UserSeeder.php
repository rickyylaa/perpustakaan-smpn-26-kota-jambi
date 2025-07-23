<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('1'),
            'role' => 'admin'
        ]);

        User::create([
            'username' => 'petugas',
            'password' => Hash::make('1'),
            'role' => 'petugas'
        ]);
    }
}
