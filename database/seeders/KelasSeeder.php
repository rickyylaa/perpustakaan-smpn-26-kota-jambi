<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $tingkatKelas = ['VII', 'VIII', 'IX'];
        $rombel = ['A', 'B', 'C', 'D', 'E'];

        foreach ($tingkatKelas as $tingkat) {
            foreach ($rombel as $kelas) {
                Kelas::create([
                    'nama_kelas' => "{$tingkat}-{$kelas}",
                    'tingkat' => $tingkat,
                    'wali_kelas' => $faker->name(),
                    'isi_kelas' => 0
                ]);
            }
        }
    }
}
