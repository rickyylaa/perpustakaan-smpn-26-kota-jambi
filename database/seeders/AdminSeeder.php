<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'user_id' => 1,
            'nip' => '123456789012345671',
            'nama' => 'Admin',
            'no_hp' => '81234567890',
            'jenis_kelamin' => 'laki-laki',
            'foto' => 'admins/avatar-01.png'
        ]);
    }
}
