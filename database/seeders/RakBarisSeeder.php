<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\RakBaris;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RakBarisSeeder extends Seeder
{
    public function run(): void
    {
        $hurufRakList = ['A', 'B', 'C'];
        $kategoris = Kategori::all();

        foreach ($kategoris as $kategori) {
            $slug = Str::slug($kategori->nama);
            $words = explode('-', $slug);

            $initials = strtoupper(substr($words[0], 0, 2));
            if (isset($words[1])) {
                $initials .= strtoupper(substr($words[1], 0, 1));
            } else {
                $initials = strtoupper(substr($words[0], 0, 3));
            }

            foreach ($hurufRakList as $index => $hurufRak) {
                $namaRak = 'Rak ' . $hurufRak;
                $nomorBaris = $index + 1;

                $kode = 'RAK-' . $initials . '-' . $kategori->id . '-' . $hurufRak . $nomorBaris;

                RakBaris::create([
                    'kategori_id' => $kategori->id,
                    'kode' => $kode,
                    'nama_rak' => $namaRak,
                    'nomor_baris' => $nomorBaris
                ]);
            }
        }
    }
}
