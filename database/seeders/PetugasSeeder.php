<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        Petugas::create([
            'user_id' => 2,
            'nip' => '123456789012345672',
            'nama' => 'Petugas',
            'no_hp' => '81234567891',
            'jenis_kelamin' => 'laki-laki',
            'foto' => 'petugas/avatar-01.png'
        ]);
    }
}
