<?php

namespace App\Http\Requests\Siswa;

use App\Models\Siswa;
use App\Rules\UniqueNISN;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $siswaId = $this->route('siswa')?->id;

        return [
            'edit_kelas_id' => ['required', 'exists:kelas,id'],
            'edit_nisn' => ['required', 'string', 'size:10', new UniqueNISN($siswaId)],
            'edit_nama' => ['required', 'string', 'max:100'],
            'edit_tempat_lahir' => ['required', 'string'],
            'edit_tanggal_lahir' => ['required', 'date'],
            'edit_jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'edit_alamat' => ['required', 'string'],
            'edit_foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'edit_kelas_id' => 'Kelas',
            'edit_nisn' => 'NISN',
            'edit_nama' => 'Nama',
            'edit_tempat_lahir' => 'Tempat Lahir',
            'edit_tanggal_lahir' => 'Tanggal Lahir',
            'edit_jenis_kelamin' => 'Jenis Kelamin',
            'edit_alamat' => 'Alamat',
            'edit_foto' => 'Foto'
        ];
    }
}
