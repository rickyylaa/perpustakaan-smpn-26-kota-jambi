<?php

namespace App\Http\Requests\Siswa;

use App\Rules\UniqueNISN;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tambah_kelas_id' => ['required', 'exists:kelas,id'],
            'tambah_nisn' => ['required', 'string', 'size:10', new UniqueNISN()],
            'tambah_nama' => ['required', 'string', 'max:100'],
            'tambah_tempat_lahir' => ['required', 'string'],
            'tambah_tanggal_lahir' => ['required', 'date'],
            'tambah_jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'tambah_alamat' => ['required', 'string'],
            'tambah_foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048']
        ];
    }

    public function attributes(): array
    {
        return [
            'tambah_kelas_id' => 'Kelas',
            'tambah_nisn' => 'NISN',
            'tambah_nama' => 'Nama',
            'tambah_tempat_lahir' => 'Tempat Lahir',
            'tambah_tanggal_lahir' => 'Tanggal Lahir',
            'tambah_jenis_kelamin' => 'Jenis Kelamin',
            'tambah_alamat' => 'Alamat',
            'tambah_foto' => 'Foto'
        ];
    }
}
