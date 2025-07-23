<?php

namespace App\Http\Requests\Kelas;

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
            'tambah_nama_kelas' => ['required', 'max:100', new UniqueNoHp()],
            'tambah_tingkat' => ['required', 'numeric'],
            'tambah_wali_kelas' => ['required', 'string', 'max:100']
        ];
    }

    public function attributes(): array
    {
        return [
            'tambah_nama_kelas' => 'Nama Kelas',
            'tambah_tingkat' => 'Tingkat',
            'tambah_wali_kelas' => 'Wali Kelas'
        ];
    }
}
