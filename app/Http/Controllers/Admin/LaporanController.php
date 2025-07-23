<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RiwayatPeminjaman;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function index()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $laporan = RiwayatPeminjaman::with(['peminjaman.siswa', 'buku'])->whereBetween('created_at', [$start, $end])->where('status', 'dikembalikan')->get();

        return view('pages.admin.laporan', compact('laporan'));
    }

    public function periode($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $laporan = RiwayatPeminjaman::with(['peminjaman.siswa', 'buku'])->whereBetween('created_at', [$start, $end])->where('status', 'dikembalikan')->get();
        $total = $laporan->sum(function ($riwayat) {
            return $riwayat->denda_keterlambatan
                + $riwayat->denda_buku_rusak
                + $riwayat->denda_buku_hilang;
        });

        return view('pages.admin.pdf', compact('laporan', 'date', 'total'));
    }
}
