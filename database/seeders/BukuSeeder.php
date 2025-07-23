<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\RakBaris;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $rakBarisIds = RakBaris::pluck('id')->toArray();
        $kategoriNames = Kategori::pluck('nama')->toArray();

        if (empty($rakBarisIds) || empty($kategoriNames)) {
            $this->command->warn('Seeder Buku dilewati karena data rak_baris atau kategori belum tersedia.');
            return;
        }

        foreach (range(1, 20) as $i) {
            $judul = $faker->sentence(3);

            Buku::create([
                'rak_baris_id' => $faker->randomElement($rakBarisIds),
                'isbn' => $faker->unique()->isbn13,
                'judul' => $judul,
                'slug' => Str::slug($judul),
                'kategori' => $faker->randomElement($kategoriNames),
                'pengarang' => $faker->name,
                'penerbit' => $faker->company,
                'tahun_terbit' => $faker->year,
                'jumlah_eksemplar' => $faker->numberBetween(1, 20),
                'deskripsi' => $faker->paragraph,
                'cover' => json_encode(['covers/default.png']),
            ]);
        }

        $this->command->info('Seeder Buku berhasil dijalankan.');
    }
}
