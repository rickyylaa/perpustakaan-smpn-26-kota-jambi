<?php

namespace App\Http\Controllers\Admin;

use App\Models\Buku;
use App\Models\Denda;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\RiwayatPeminjaman;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.admin.pengembalian');
    }

    public function cek(Request $request)
    {
        $request->validate([
            'kode_anggota' => 'required|string'
        ]);

        $siswa = Siswa::where('kode_anggota', $request->kode_anggota)->first();

        if ($siswa) {
            return redirect()->route('admin.formPengembalian', ['kode_anggota' => $request->kode_anggota]);
        }

        sweetalert()->error('Siswa tidak ditemukan');
        return redirect()->route('admin.pengembalian');
    }

    public function form($kode_anggota)
    {
        $siswa = Siswa::where('kode_anggota', $kode_anggota)->firstOrFail();
        $denda = Denda::first();

        $riwayat = RiwayatPeminjaman::with('peminjaman')
            ->whereHas('peminjaman', function ($query) use ($siswa) {
                $query->where('siswa_id', $siswa->id);
            })
            ->where('status', 'dipinjam')
            ->get();

        foreach ($riwayat as $data) {
            $tanggalDeadline = strtotime($data->peminjaman->tanggal_deadline);
            $tanggalSekarang = time();

            if ($tanggalSekarang > $tanggalDeadline) {
                $diffDetik = $tanggalSekarang - $tanggalDeadline;
                $data->keterlambatanHari = floor($diffDetik / (60 * 60 * 24));
            } else {
                $data->keterlambatanHari = 0;
            }

            $data->denda_keterlambatan = $data->keterlambatanHari * ($denda->denda_keterlambatan ?? 0);
        }

        return view('pages.admin.pengembalian-form', compact('siswa', 'denda', 'riwayat'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'denda_keterlambatan' => 'nullable|integer',
            'denda_buku_rusak' => 'nullable|integer',
            'denda_buku_hilang' => 'nullable|integer',
            'catatan' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $riwayat = RiwayatPeminjaman::with(['peminjaman' => function ($query) {
                $query->withTrashed();
            }])->findOrFail($id);

            $denda = Denda::firstOrFail();
            $bukuId = $riwayat->buku_id;

            $riwayat->update([
                'tanggal_kembali' => now(),
                'denda_keterlambatan' => $request->denda_keterlambatan ?? 0,
                'denda_buku_rusak' => $request->has('denda_buku_rusak') ? $denda->denda_buku_rusak : 0,
                'denda_buku_hilang' => $request->has('denda_buku_hilang') ? $denda->denda_buku_hilang : 0,
                'catatan' => $request->catatan,
                'status' => 'dikembalikan'
            ]);

            if (!$request->has('denda_buku_hilang') || $request->denda_buku_hilang == 0) {
                Buku::where('id', $bukuId)->increment('jumlah_eksemplar');
            }

            $masihDipinjam = RiwayatPeminjaman::where('peminjaman_id', $riwayat->peminjaman_id)
                ->where('status', 'dipinjam')
                ->exists();

            if (!$masihDipinjam) {
                $riwayat->peminjaman->update([
                    'status' => 'selesai'
                ]);
            }

            DB::commit();

            toastr()->success('Buku berhasil dikembalikan!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }
}
