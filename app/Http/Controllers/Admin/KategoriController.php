<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::query();

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%")
                    ->orWhere('slug', 'like', "%{$cari}%");
            });
        }

        $kategori = $query->orderBy('id', 'ASC')->paginate(10);
        $kategori->appends($request->only('cari'));

        return view('pages.admin.kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tambah_nama' => 'required|string|max:100'
        ]);

        try {
            DB::beginTransaction();

            Kategori::create([
                'nama' => $request->tambah_nama,
                'slug' => Str::slug($request->tambah_nama)
            ]);

            DB::commit();

            toastr()->success('Kategori berhasil ditambahkan!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }

    public function edit(string $id)
    {
        $kategori = Kategori::find($id);

        if ($kategori) {
            return response()->json($kategori);
        }

        return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'edit_nama' => 'required|string|max:100'
        ]);

        try {
            DB::beginTransaction();

            $kategori->update([
                'nama' => $request->edit_nama,
                'slug' => Str::slug($request->edit_nama)
            ]);

            DB::commit();

            toastr()->success('Kategori berhasil diperbarui!');
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

            $kategori = Kategori::findOrFail($id);
            $kategori->delete();

            DB::commit();

            toastr()->success('Kategori berhasil dihapus!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }
}
