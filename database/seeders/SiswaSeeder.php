<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Siswa;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $tahunSekarang = date('Y');

        $nomorUrut = 1;

        $kelasList = Kelas::pluck('id')->toArray();

        for ($i = 0; $i < 400; $i++) {
            $umurMasuk = $faker->numberBetween(6, 7);
            $tahunLahir = $tahunSekarang - $faker->numberBetween(0, 5) - $umurMasuk;
            $tanggalLahir = Carbon::createFromDate($tahunLahir, rand(1, 12), rand(1, 28));

            $jenisKelamin = $faker->randomElement(['laki-laki', 'perempuan']);
            $namaLengkap = $faker->name($jenisKelamin === 'laki-laki' ? 'male' : 'female');
            $nama = preg_replace('/\s+[A-Z][a-zA-Z\.]{1,10}$/', '', $namaLengkap);

            $kelasKe = $tahunSekarang - $tahunLahir - 6;
            $kelasKe = max(1, min(6, $kelasKe));

            $kelasId = Kelas::where('tingkat', $kelasKe)->inRandomOrder()->first()->id
                ?? $kelasList[array_rand($kelasList)];

            $nisn = $faker->unique()->numerify('##########');

            do {
                $kodeAnggota = 'SISWA' . $tahunSekarang . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);
                $nomorUrut++;
            } while (Siswa::where('kode_anggota', $kodeAnggota)->exists());

            $foto = $jenisKelamin === 'laki-laki'
                ? 'siswas/avatar-01.png'
                : 'siswas/avatar-02.png';

            Siswa::create([
                'kelas_id' => $kelasId,
                'nisn' => $nisn,
                'kode_anggota' => $kodeAnggota,
                'nama' => $nama,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $tanggalLahir->format('Y-m-d'),
                'jenis_kelamin' => $jenisKelamin,
                'alamat' => $faker->address,
                'foto' => $foto
            ]);

            Kelas::find($kelasId)?->increment('isi_kelas');
        }
    }
}
