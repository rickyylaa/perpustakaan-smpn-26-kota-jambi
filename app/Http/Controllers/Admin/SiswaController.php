<?php

namespace App\Http\Controllers\Admin;

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
        $kelas = Kelas::orderBy('id', 'ASC')->get();

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

        $siswa = $query->orderBy('id', 'DESC')->paginate(10);
        $siswa->appends($request->only('cari'));

        return view('pages.admin.siswa', compact('siswa', 'kelas'));
    }

    public function store(ValidateStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $tahunSekarang = date('Y');
            $nomorUrut = 1;

            do {
                $lastSiswa = Siswa::where('kode_anggota', 'like', 'SISWA' . $tahunSekarang . '%')
                    ->orderBy('kode_anggota', 'DESC')
                    ->first();

                if ($lastSiswa) {
                    $lastNumber = (int) substr($lastSiswa->kode_anggota, -4);
                    $nomorUrut = $lastNumber + 1;
                }

                $kodeAnggota = 'SISWA' . $tahunSekarang . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);
            } while (Siswa::where('kode_anggota', $kodeAnggota)->exists());

            $jenisKelamin = $request->tambah_jenis_kelamin;
            $fotoPath = match ($jenisKelamin) {
                'laki-laki' => 'avatars/avatar-01.png',
                'perempuan' => 'avatars/avatar-02.png'
            };

            if ($request->hasFile('tambah_foto') && $request->file('tambah_foto')->isValid()) {
                $fotoPath = $request->file('tambah_foto')
                    ->storeAs('siswas', $request->file('tambah_foto')->hashName(), 'public');
            }

            Siswa::create([
                'kelas_id' => $request->tambah_kelas_id,
                'kode_anggota' => $kodeAnggota,
                'nisn' => $request->tambah_nisn,
                'nama' => $request->tambah_nama,
                'tempat_lahir' => $request->tambah_tempat_lahir,
                'tanggal_lahir' => $request->tambah_tanggal_lahir,
                'jenis_kelamin' => $request->tambah_jenis_kelamin,
                'alamat' => $request->tambah_alamat,
                'foto' => $fotoPath
            ]);

            Kelas::where('id', $request->tambah_kelas_id)->increment('isi_kelas');

            DB::commit();

            toastr()->success('Siswa berhasil ditambahkan!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back()->withInput();
        }
    }

    public function edit(string $id)
    {
        $siswa = Siswa::find($id);

        if ($siswa) {
            return response()->json($siswa);
        }

        return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
    }

    public function update(ValidateUpdateRequest $request, Siswa $siswa)
    {
        try {
            DB::beginTransaction();

            $kelasLamaId = $siswa->kelas_id;
            $kelasBaruId = $request->edit_kelas_id;

            $fotoPath = $siswa->foto;
            if ($request->hasFile('edit_foto') && $request->file('edit_foto')->isValid()) {
                $defaultAvatars = [
                    'avatars/avatar-01.png',
                    'avatars/avatar-02.png'
                ];
                if ($siswa->foto && !in_array($siswa->foto, $defaultAvatars) && file_exists(public_path('storage/' . $siswa->foto))) {
                    unlink(public_path('storage/' . $siswa->foto));
                }
                $fotoPath = $request->file('edit_foto')->storeAs('siswas', $request->file('edit_foto')->hashName(), 'public');
            } else {
                if (in_array($siswa->foto, ['avatars/avatar-01.png', 'avatars/avatar-02.png'])) {
                    $jenisKelamin = $request->edit_jenis_kelamin;
                    $fotoPath = match ($jenisKelamin) {
                        'laki-laki' => 'avatars/avatar-01.png',
                        'perempuan' => 'avatars/avatar-02.png'
                    };
                }
            }

            $siswa->update([
                'kelas_id' => $request->edit_kelas_id,
                'kode_anggota' => $siswa->kode_anggota,
                'nisn' => $request->edit_nisn,
                'nama' => $request->edit_nama,
                'tempat_lahir' => $request->edit_tempat_lahir,
                'tanggal_lahir' => $request->edit_tanggal_lahir,
                'jenis_kelamin' => $request->edit_jenis_kelamin,
                'alamat' => $request->edit_alamat,
                'foto' => $fotoPath
            ]);

            if ($kelasLamaId != $kelasBaruId) {
                $kelasLama = Kelas::find($kelasLamaId);
                if ($kelasLama) {
                    $kelasLama->decrement('isi_kelas');
                }

                $kelasBaru = Kelas::find($kelasBaruId);
                if ($kelasBaru) {
                    $kelasBaru->increment('isi_kelas');
                }
            }

            DB::commit();

            toastr()->success('Siswa berhasil diperbarui!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $siswa = Siswa::findOrFail($id);
            $siswa->delete();

            DB::commit();

            toastr()->success('Siswa berhasil dihapus!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back()->withInput();
        }
    }

    public function print($kode_anggota)
    {
        $siswa = Siswa::where('kode_anggota', $kode_anggota)->firstOrFail();
        return view('pages.admin.kartu-anggota', compact('siswa'));
    }
}
