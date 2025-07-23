<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Buku;
use App\Models\Siswa;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\RiwayatPeminjaman;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $month = now()->format('m');
        $year = now()->format('Y');

        $totalSiswa = Siswa::count();
        $totalBuku = Buku::count();
        $totalPeminjaman = Peminjaman::where('status', 'dipinjam')->count();
        $totalPengembalian = RiwayatPeminjaman::where('status', 'dikembalikan')->count();

        return view('pages.petugas.dashboard', compact('totalSiswa', 'totalBuku', 'totalPeminjaman', 'totalPengembalian'));
    }
}
