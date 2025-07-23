<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            PetugasSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            KategoriSeeder::class,
            RakBarisSeeder::class,
            BukuSeeder::class,
            DendaSeeder::class,
        ]);
    }
}
