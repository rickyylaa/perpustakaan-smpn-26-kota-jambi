<?php

namespace App\Http\Requests\Petugas;

use App\Rules\UniqueNIP;
use App\Rules\UniqueNoHp;
use App\Rules\UniqueUsername;
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
        $petugasId = $this->route('petugas')?->id;

        return [
            'edit_username' => ['required', 'string', 'max:100', new UniqueUsername($this->petugas?->user_id)],
            'edit_password' => ['nullable', 'string', 'max:100', 'confirmed'],
            'edit_nip' => ['required', 'string', 'size:18', new UniqueNIP($petugasId, 'petugas')],
            'edit_nama' => ['required', 'string', 'max:100'],
            'edit_no_hp' => ['required', 'digits_between:10,15', new UniqueNoHp($petugasId, 'petugas')],
            'edit_jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'edit_foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048']
        ];
    }

    public function messages()
    {
        return [
            'edit_password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }

    public function attributes(): array
    {
        return [
            'edit_username' => 'Username',
            'edit_password' => 'Password',
            'edit_nip' => 'NIP',
            'edit_nama' => 'Nama',
            'edit_no_hp' => 'No Hp',
            'edit_jenis_kelamin' => 'Jenis Kelamin',
            'edit_foto' => 'Foto'
        ];
    }
}
