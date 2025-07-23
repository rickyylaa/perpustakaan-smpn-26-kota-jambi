<?php

namespace Database\Seeders;

use App\Models\Denda;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Denda::create([
            'denda_keterlambatan' => '3000',
            'denda_buku_rusak' => '10000',
            'denda_buku_hilang' => '50000'
        ]);
    }
}
