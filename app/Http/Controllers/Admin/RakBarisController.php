<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use App\Models\RakBaris;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\RakBaris\ValidateStoreRequest;
use App\Http\Requests\RakBaris\ValidateUpdateRequest;

class RakBarisController extends Controller
{
    public function index(Request $request)
    {
        $query = RakBaris::query();
        $kategori = Kategori::orderBy('id', 'ASC')->get();

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('kode', 'like', "%{$cari}%")
                    ->orWhere('nama_rak', 'like', "%{$cari}%")
                    ->orWhere('nomor_baris', 'like', "%{$cari}%");
            });
        }

        $rakbaris = $query->orderBy('id', 'ASC')->paginate(10);
        $rakbaris->appends($request->only('cari'));

        return view('pages.admin.rakbaris', compact('rakbaris', 'kategori'));
    }

    public function store(ValidateStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $namaRak = $request->tambah_nama_rak;
            $kategoriId = $request->tambah_kategori_id;
            $nomorBaris = $request->tambah_nomor_baris;

            $kategori = Kategori::findOrFail($kategoriId);
            $slug = Str::slug($kategori->nama);
            $words = explode('-', $slug);

            $initials = strtoupper(substr($words[0], 0, 2));
            if (isset($words[1])) {
                $initials .= strtoupper(substr($words[1], 0, 1));
            } else {
                $initials = strtoupper(substr($words[0], 0, 3));
            }

            $hurufRak = strtoupper(substr($namaRak, 0, 1));
            $kode = 'RAK-' . $initials . '-' . $hurufRak . $nomorBaris;

            if (RakBaris::where('kode', $kode)->exists()) {
                DB::rollBack();

                sweetalert()->error('Rak & Baris telah digunakan!');
                return back();
            }

            RakBaris::create([
                'kategori_id' => $kategoriId,
                'kode' => $kode,
                'nama_rak' => $namaRak,
                'nomor_baris' => $nomorBaris
            ]);

            DB::commit();

            toastr()->success('Rak & Baris berhasil ditambahkan!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back()->withInput();
        }
    }

    public function edit(string $id)
    {
        $rakbaris = RakBaris::find($id);

        if ($rakbaris) {
            return response()->json($rakbaris);
        }

        return response()->json(['message' => 'RakBaris tidak ditemukan'], 404);
    }

    public function update(ValidateUpdateRequest $request, RakBaris $rakbaris)
    {
        try {
            DB::beginTransaction();

            $namaRak = $request->edit_nama_rak;
            $kategoriId = $request->edit_kategori_id;
            $nomorBaris = $request->edit_nomor_baris;

            $kategori = Kategori::findOrFail($kategoriId);
            $slug = Str::slug($kategori->nama);
            $words = explode('-', $slug);

            $initials = strtoupper(substr($words[0], 0, 2));
            if (isset($words[1])) {
                $initials .= strtoupper(substr($words[1], 0, 1));
            } else {
                $initials = strtoupper(substr($words[0], 0, 3));
            }

            $hurufRak = strtoupper(substr($namaRak, 0, 1));
            $kode = 'RAK-' . $initials . '-' . $hurufRak . $nomorBaris;

            if (RakBaris::where('kode', $kode)->where('id', '!=', $rakbaris->id)->exists()) {
                DB::rollBack();

                sweetalert()->error('Rak & Baris telah digunakan!');
                return back();
            }

            $rakbaris->update([
                'kategori_id' => $kategoriId,
                'kode' => $kode,
                'nama_rak' => $namaRak,
                'nomor_baris' => $nomorBaris
            ]);

            DB::commit();

            toastr()->success('Rak & Baris  berhasil diperbarui!');
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

            $rakbaris = RakBaris::findOrFail($id);
            $rakbaris->delete();

            DB::commit();

            toastr()->success('Rak & Baris  berhasil dihapus!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back()->withInput();
        }
    }
}
