<?php

namespace App\Http\Controllers\Admin;

use App\Models\Denda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Denda::query();

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('denda_keterlambatan', 'like', "%{$cari}%")
                    ->orWhere('denda_buku_rusak', 'like', "%{$cari}%")
                    ->orWhere('denda_buku_hilang', 'like', "%{$cari}%");
            });
        }

        $denda = $query->orderBy('id', 'ASC')->paginate(10);
        $denda->appends($request->only('cari'));

        return view('pages.admin.denda', compact('denda'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tambah_denda_keterlambatan' => 'required|numeric',
            'tambah_denda_buku_rusak' => 'required|numeric',
            'tambah_denda_buku_hilang' => 'required|numeric'
        ]);

        try {
            DB::beginTransaction();

            Denda::create([
                'denda_keterlambatan' => $request->tambah_denda_keterlambatan,
                'denda_buku_rusak' => $request->tambah_denda_buku_rusak,
                'denda_buku_hilang' => $request->tambah_denda_buku_hilang
            ]);

            DB::commit();

            toastr()->success('Denda berhasil ditambahkan!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }

    public function edit(string $id)
    {
        $denda = Denda::find($id);

        if ($denda) {
            return response()->json($denda);
        }

        return response()->json(['message' => 'Denda tidak ditemukan'], 404);
    }

    public function update(Request $request, Denda $denda)
    {
        $request->validate([
            'edit_denda_keterlambatan' => 'required|numeric',
            'edit_denda_buku_rusak' => 'required|numeric',
            'edit_denda_buku_hilang' => 'required|numeric'
        ]);

        try {
            DB::beginTransaction();

            $denda->update([
                'denda_keterlambatan' => $request->edit_denda_keterlambatan,
                'denda_buku_rusak' => $request->edit_denda_buku_rusak,
                'denda_buku_hilang' => $request->edit_denda_buku_hilang
            ]);

            DB::commit();

            toastr()->success('Denda berhasil diperbarui!');
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

            $denda = Denda::findOrFail($id);
            $denda->delete();

            DB::commit();

            toastr()->success('Denda berhasil dihapus!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }
}
