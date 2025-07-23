<?php

namespace App\Http\Requests\Petugas;

use App\Rules\UniqueNIP;
use App\Rules\UniqueNoHp;
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
            'tambah_nip' => ['required', 'string', 'size:18', new UniqueNIP()],
            'tambah_nama' => ['required', 'string', 'max:100'],
            'tambah_no_hp' => ['required', 'digits_between:10,15', new UniqueNoHp()],
            'tambah_jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'tambah_foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048']
        ];
    }

    public function attributes(): array
    {
        return [
            'tambah_nip' => 'NIP',
            'tambah_nama' => 'Nama',
            'tambah_no_hp' => 'No Hp',
            'tambah_jenis_kelamin' => 'Jenis Kelamin',
            'tambah_foto' => 'Foto'
        ];
    }
}
