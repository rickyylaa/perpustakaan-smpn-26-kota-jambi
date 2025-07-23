<?php

namespace App\Http\Controllers\Petugas;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Siswa;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\RiwayatPeminjaman;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.petugas.peminjaman');
    }

    public function cek(Request $request)
    {
        $request->validate([
            'kode_anggota' => 'required|string'
        ]);

        $siswa = Siswa::where('kode_anggota', $request->kode_anggota)->first();

        if ($siswa) {
            return redirect()->route('petugas.formPeminjaman', ['kode_anggota' => $request->kode_anggota]);
        }

        sweetalert()->error('Siswa tidak ditemukan');
        return redirect()->route('petugas.peminjaman');
    }

    public function form($kode_anggota)
    {
        $siswa = Siswa::where('kode_anggota', $kode_anggota)->firstOrFail();
        $buku = Buku::orderBy('id', 'ASC')->get();
        $denda = Denda::first();

        $denda_keterlambatan = 'Rp' . number_format($denda->denda_keterlambatan, 0, ',', '.') . ',-';
        $denda_buku_rusak = 'Rp' . number_format($denda->denda_buku_rusak, 0, ',', '.') . ',-';
        $denda_buku_hilang = 'Rp' . number_format($denda->denda_buku_hilang, 0, ',', '.') . ',-';

        return view('pages.petugas.peminjaman-form', compact('siswa', 'buku', 'denda', 'denda_keterlambatan', 'denda_buku_rusak', 'denda_buku_hilang'));
    }

    public function store(Request $request, $kode_anggota)
    {
        $request->validate([
            'buku1' => 'nullable|exists:bukus,id',
            'buku2' => 'nullable|exists:bukus,id|different:buku1',
            'buku3' => 'nullable|exists:bukus,id|different:buku1|different:buku2',
        ], [
            'buku2.different' => 'Buku 2 tidak boleh sama dengan Buku 1.',
            'buku3.different' => 'Buku 3 tidak boleh sama dengan Buku 1 atau Buku 2.',
            'exists' => 'Buku yang dipilih tidak valid.',
        ]);

        $siswa = Siswa::where('kode_anggota', $kode_anggota)->firstOrFail();
        $bukuIds = collect([$request->buku1, $request->buku2, $request->buku3])->filter()->unique()->values();

        if ($bukuIds->isEmpty()) {
            sweetalert()->error('Harap pilih minimal 1 buku untuk dipinjam');
            return back();
        }

        if ($bukuIds->count() > 3) {
            sweetalert()->error('Maksimal hanya boleh meminjam 3 buku');
            return back();
        }

        $peminjamanAktif = RiwayatPeminjaman::whereHas('peminjaman', function ($query) use ($siswa) {
            $query->where('siswa_id', $siswa->id);
        })->where('status', 'dipinjam')->get();

        $jumlahPeminjamanAktif = $peminjamanAktif->count();
        $bukuSedangDipinjam = $peminjamanAktif->pluck('buku_id')->toArray();
        $bukuDuplikat = array_intersect($bukuIds->toArray(), $bukuSedangDipinjam);

        if (!empty($bukuDuplikat)) {
            sweetalert()->error('Siswa telah meminjam buku ini');
            return back();
        }

        if ($jumlahPeminjamanAktif + $bukuIds->count() > 3) {
            sweetalert()->error('Siswa hanya boleh meminjam maksimal 3 buku');
            return back();
        }

        $bukuTidakTersedia = Buku::whereIn('id', $bukuIds)
            ->where('jumlah_eksemplar', '<=', 0)
            ->pluck('judul')
            ->toArray();

        if (!empty($bukuTidakTersedia)) {
            sweetalert()->error('Stok buku sudah tidak tersedia');
            return back();
        }

        try {
            DB::beginTransaction();

            $tanggalPinjam = Carbon::now();
            $tanggalDeadline = $tanggalPinjam->copy()->addDays(7);

            $peminjaman = Peminjaman::create([
                'siswa_id' => $siswa->id,
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_deadline' => $tanggalDeadline,
                'status' => 'dipinjam'
            ]);

            foreach ($bukuIds as $bukuId) {
                RiwayatPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'buku_id' => $bukuId,
                    'tanggal_pinjam' => $tanggalPinjam,
                    'tanggal_deadline' => $tanggalDeadline,
                    'status' => 'dipinjam'
                ]);

                Buku::where('id', $bukuId)->decrement('jumlah_eksemplar');
            }

            DB::commit();

            toastr()->success('Buku berhasil dipinjamkan!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }
}
