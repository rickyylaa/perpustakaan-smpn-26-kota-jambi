<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Petugas\ValidateStoreRequest;
use App\Http\Requests\Petugas\ValidateUpdateRequest;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $query = Petugas::query();

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('nip', 'like', "%{$cari}%")
                    ->orWhere('nama', 'like', "%{$cari}%")
                    ->orWhere('no_hp', 'like', "%{$cari}%")
                    ->orWhere('jenis_kelamin', 'like', "%{$cari}%");
            });
        }

        $petugas = $query->orderBy('id', 'ASC')->paginate(10);
        $petugas->appends($request->only('cari'));

        return view('pages.admin.petugas', compact('petugas'));
    }

    public function store(ValidateStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $jenisKelamin = $request->tambah_jenis_kelamin;
            $fotoPath = match ($jenisKelamin) {
                'laki-laki' => 'avatars/avatar-01.png',
                'perempuan' => 'avatars/avatar-02.png'
            };

            if ($request->hasFile('tambah_foto') && $request->file('tambah_foto')->isValid()) {
                $fotoPath = $request->file('tambah_foto')
                    ->storeAs('petugas', $request->file('tambah_foto')->hashName(), 'public');
            }

            $username = strtolower(strtok($request->tambah_nama, ' ')) . rand(100, 999);
            $password = strtolower(strtok($request->tambah_nama, ' ')) . rand(100, 999);

            $user = User::create([
                'username' => $username,
                'password' => Hash::make($password)
            ]);

            Petugas::create([
                'user_id' => $user->id,
                'nip' => $request->tambah_nip,
                'nama' => $request->tambah_nama,
                'no_hp' => $request->tambah_no_hp,
                'jenis_kelamin' => $request->tambah_jenis_kelamin,
                'foto' => $fotoPath
            ]);

            DB::commit();

            toastr()->success('Petugas berhasil ditambahkan!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }

    public function edit(string $id)
    {
        $petugas = Petugas::with('user')->find($id);

        if ($petugas) {
            return response()->json($petugas);
        }

        return response()->json(['message' => 'Petugas tidak ditemukan'], 404);
    }

    public function update(ValidateUpdateRequest $request, Petugas $petugas)
    {
        try {
            DB::beginTransaction();

            $fotoPath = $petugas->foto;
            if ($request->hasFile('edit_foto') && $request->file('edit_foto')->isValid()) {
                $defaultAvatars = [
                    'avatars/avatar-01.png',
                    'avatars/avatar-02.png'
                ];
                if ($petugas->foto && !in_array($petugas->foto, $defaultAvatars) && file_exists(public_path('storage/' . $petugas->foto))) {
                    unlink(public_path('storage/' . $petugas->foto));
                }
                $fotoPath = $request->file('edit_foto')->storeAs('petugas', $request->file('edit_foto')->hashName(), 'public');
            } else {
                if (in_array($petugas->foto, ['avatars/avatar-01.png', 'avatars/avatar-02.png'])) {
                    $jenisKelamin = $request->edit_jenis_kelamin;
                    $fotoPath = match ($jenisKelamin) {
                        'laki-laki' => 'avatars/avatar-01.png',
                        'perempuan' => 'avatars/avatar-02.png'
                    };
                }
            }

            $userData = ['username' => $request->edit_username];

            if ($request->edit_password) {
                $userData['password'] = Hash::make($request->edit_password);
            }

            $petugas->user()->update($userData);

            $petugas->update([
                'nip' => $request->edit_nip,
                'nama' => $request->edit_nama,
                'no_hp' => $request->edit_no_hp,
                'jenis_kelamin' => $request->edit_jenis_kelamin,
                'foto' => $fotoPath
            ]);

            DB::commit();

            toastr()->success('Petugas berhasil diperbarui!');
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

            $petugas = Petugas::findOrFail($id);
            $petugas->delete();

            DB::commit();

            toastr()->success('Petugas berhasil dihapus!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            sweetalert()->error('Terjadi kesalahan');
            return back();
        }
    }
}
