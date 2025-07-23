<?php

namespace App\Http\Controllers\Admin;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Buku\ValidateStoreRequest;
use App\Http\Requests\Buku\ValidateUpdateRequest;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query();
        $kategori = Kategori::orderBy('id', 'ASC')->get();

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('isbn', 'like', "%{$cari}%")
                    ->orWhere('judul', 'like', "%{$cari}%")
                    ->orWhere('slug', 'like', "%{$cari}%")
                    ->orWhere('kategori', 'like', "%{$cari}%")
                    ->orWhere('pengarang', 'like', "%{$cari}%")
                    ->orWhere('penerbit', 'like', "%{$cari}%")
                    ->orWhere('tahun_terbit', 'like', "%{$cari}%")
                    ->orWhere('jumlah_eksemplar', 'like', "%{$cari}%")
                    ->orWhere('deskripsi', 'like', "%{$cari}%");
            });
        }

        $buku = $query->orderBy('id', 'ASC')->paginate(10);
        $buku->appends($request->only('cari'));

        return view('pages.admin.buku', compact('buku', 'kategori'));
    }

    public function store(ValidateStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $coverPath = [];
            if ($request->hasFile('tambah_cover')) {
                foreach ($request->file('tambah_cover') as $cover) {
                    $coverPath[] = $cover->store('covers', 'public');
                }
            } else {
                $coverPath[] = 'covers/default.png';
            }

            $kategoriNama = Kategori::where('id', $request->tambah_kategori)->first()->nama ?? null;

            $slug = Str::slug($request->tambah_judul);
            $originalSlug = $slug;

            $counter = 1;
            while (Buku::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            Buku::create([
                'rak_baris_id' => $request->tambah_rak_baris_id,
                'isbn' => $request->tambah_isbn,
                'judul' => $request->tambah_judul,
                'slug' => $slug,
                'kategori' => $kategoriNama,
                'pengarang' => $request->tambah_pengarang,
                'penerbit' => $request->tambah_penerbit,
                'tahun_terbit' => $request->tambah_tahun_terbit,
                'jumlah_eksemplar' => $request->tambah_jumlah_eksemplar,
                'deskripsi' => $request->tambah_deskripsi,
                'cover' => json_encode($coverPath)
            ]);

            DB::commit();

            toastr()->success('Buku berhasil ditambahkan!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }

    public function edit(string $id)
    {
        $buku = Buku::with('rak_baris')->find($id);

        if ($buku) {
            $buku->cover = json_decode($buku->cover, true);
            $buku->kategori_id = $buku->rak_baris->kategori_id ?? null;
            return response()->json($buku);
        }

        return response()->json(['message' => 'Buku tidak ditemukan'], 404);
    }

    public function update(ValidateUpdateRequest $request, Buku $buku)
    {
        try {
            DB::beginTransaction();

            if ($buku->cover) {
                foreach (json_decode($buku->cover, true) as $oldCover) {
                    $oldCoverPath = public_path('storage/' . $oldCover);
                    if (file_exists($oldCoverPath) && $oldCover !== 'covers/default.png') {
                        unlink($oldCoverPath);
                    }
                }
            }

            $coverPath = [];
            if ($request->hasFile('edit_cover')) {
                foreach ($request->file('edit_cover') as $cover) {
                    $coverPath[] = $cover->store('covers', 'public');
                }
            } else {
                $coverPath[] = 'covers/default.png';
            }

            $kategoriNama = Kategori::where('id', $request->edit_kategori)->first()->nama ?? $buku->kategori;

            $slug = Str::slug($request->edit_judul);
            $originalSlug = $slug;

            $counter = 1;
            while (Buku::where('slug', $slug)->where('id', '!=', $buku->id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $buku->update([
                'rak_baris_id' => $request->edit_rak_baris_id,
                'isbn' => $request->edit_isbn,
                'judul' => $request->edit_judul,
                'slug' => $slug,
                'kategori' => $kategoriNama,
                'pengarang' => $request->edit_pengarang,
                'penerbit' => $request->edit_penerbit,
                'tahun_terbit' => $request->edit_tahun_terbit,
                'jumlah_eksemplar' => $request->edit_jumlah_eksemplar,
                'deskripsi' => $request->edit_deskripsi,
                'cover' => json_encode($coverPath)
            ]);

            DB::commit();

            toastr()->success('Buku berhasil diperbarui!');
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

            $buku = Buku::findOrFail($id);
            $buku->delete();

            DB::commit();

            toastr()->success('Buku berhasil dihapus!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }
}
