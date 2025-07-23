<?php

namespace App\Http\Controllers\Admin;

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

        return view('pages.admin.dashboard', compact('totalSiswa', 'totalBuku', 'totalPeminjaman', 'totalPengembalian'));
    }
}
