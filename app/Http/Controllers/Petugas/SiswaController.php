<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\ValidateStoreRequest;
use App\Http\Requests\Siswa\ValidateUpdateRequest;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();
        $kela = Kelas::orderBy('id', 'ASC')->get();

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('kode_anggota', 'like', "%{$cari}%")
                    ->orWhere('nisn', 'like', "%{$cari}%")
                    ->orWhere('nama', 'like', "%{$cari}%")
                    ->orWhere('tempat_lahir', 'like', "%{$cari}%")
                    ->orWhere('tanggal_lahir', 'like', "%{$cari}%")
                    ->orWhere('jenis_kelamin', 'like', "%{$cari}%")
                    ->orWhere('alamat', 'like', "%{$cari}%");
            });
        }

        $siswa = $query->orderBy('id', 'ASC')->paginate(10);
        $siswa->appends($request->only('cari'));

        return view('pages.petugas.siswa', compact('siswa', 'kela'));
    }

    public function print($kode_anggota)
    {
        $siswa = Siswa::where('kode_anggota', $kode_anggota)->firstOrFail();
        return view('pages.petugas.kartu-anggota', compact('siswa'));
    }
}
