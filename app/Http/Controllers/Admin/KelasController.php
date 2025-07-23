<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\ValidateStoreRequest;
use App\Http\Requests\Kelas\ValidateUpdateRequest;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $query = Kelas::query();

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('nama_kelas', 'like', "%{$cari}%")
                    ->orWhere('tingkat', 'like', "%{$cari}%")
                    ->orWhere('wali_kelas', 'like', "%{$cari}%");
            });
        }

        $kelas = $query->orderBy('id', 'ASC')->paginate(10);
        $kelas->appends($request->only('cari'));

        return view('pages.admin.kelas', compact('kelas'));
    }

    public function store(ValidateStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            Kelas::create([
                'nama_kelas' => $request->tambah_nama_kelas,
                'tingkat' => $request->tambah_tingkat,
                'wali_kelas' => $request->tambah_wali_kelas,
                'isi_kelas' => 0
            ]);

            DB::commit();

            toastr()->success('Kelas berhasil ditambahkan!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }

    public function edit(string $id)
    {
        $kelas = Kelas::find($id);

        if ($kelas) {
            return response()->json($kelas);
        }

        return response()->json(['message' => 'Kelas tidak ditemukan'], 404);
    }

    public function update(ValidateUpdateRequest $request, Kelas $kelas)
    {
        try {
            DB::beginTransaction();

            $kelas->update([
                'nama_kelas' => $request->edit_nama_kelas,
                'tingkat' => $request->edit_tingkat,
                'wali_kelas' => $request->edit_wali_kelas,
                'isi_kelas' => 0
            ]);

            DB::commit();

            toastr()->success('Kelas berhasil diperbarui!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $kelas = Kelas::findOrFail($id);
            $kelas->delete();

            DB::commit();

            toastr()->success('Kelas berhasil dihapus!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }
}
