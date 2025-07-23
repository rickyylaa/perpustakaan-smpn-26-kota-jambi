<?php

namespace App\Http\Requests\RakBaris;

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
            'tambah_kategori_id' => ['required', 'exists:kategoris,id'],
            'tambah_nama_rak' => ['required', 'string', 'max:100'],
            'tambah_nomor_baris' => ['required', 'numeric']
        ];
    }

    public function attributes(): array
    {
        return [
            'tambah_kategori_id' => 'Kategori',
            'tambah_nama_rak' => 'Rak',
            'tambah_nomor_baris' => 'Baris'
        ];
    }
}
