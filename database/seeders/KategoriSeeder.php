<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriBuku = [
            'IPA',
            'IPS',
            'Sejarah',
            'Matematika',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Ekonomi',
            'Geografi',
            'Fisika',
            'Kimia',
            'Biologi',
            'Sosiologi'
        ];

        foreach ($kategoriBuku as $kategori) {
            Kategori::create([
                'nama' => $kategori,
                'slug' => Str::slug($kategori)
            ]);
        }
    }
}
