<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Siswa;
use App\Models\RakBaris;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getRakBaris($kategoriId)
    {
        $rakBarisList = RakBaris::where('kategori_id', $kategoriId)->get();
        return response()->json($rakBarisList);
    }

    public function getPinjam($kode_anggota)
    {
        $siswa = Siswa::where('kode_anggota', $kode_anggota)->firstOrFail();

        $bukuDipinjam = DB::table('riwayat_peminjamans')
            ->join('peminjamans', 'riwayat_peminjamans.peminjaman_id', '=', 'peminjamans.id')
            ->where('peminjamans.siswa_id', $siswa->id)
            ->where('riwayat_peminjamans.status', 'dipinjam')
            ->whereNull('riwayat_peminjamans.deleted_at')
            ->pluck('riwayat_peminjamans.buku_id')
            ->toArray();

        return response()->json($bukuDipinjam);
    }

    public function getBuku($isbn)
    {
        $buku = Buku::where('isbn', $isbn)
            ->where('jumlah_eksemplar', '>', 0)
            ->first();

        if ($buku) {
            return response()->json([
                'success' => true,
                'book' => [
                    'id' => $buku->id,
                    'judul' => $buku->judul,
                    'isbn' => $buku->isbn,
                    'jumlah_eksemplar' => $buku->jumlah_eksemplar
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Buku tidak ditemukan atau stok habis'
        ], 404);
    }

    public function getAnggota($kode_anggota)
    {
        try {
            $anggota = Siswa::with('kelas')
                ->where('kode_anggota', $kode_anggota)
                ->first();

            if (!$anggota) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anggota tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $anggota->id,
                    'kode_anggota' => $anggota->kode_anggota,
                    'nama' => $anggota->nama,
                    'kelas' => $anggota->kelas->nama ?? null
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ], 500);
        }
    }
}
