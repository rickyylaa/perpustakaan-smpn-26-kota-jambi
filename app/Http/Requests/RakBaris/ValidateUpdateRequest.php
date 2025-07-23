<?php

namespace App\Http\Requests\RakBaris;

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
        return [
            'edit_kategori_id' => ['required', 'exists:kategoris,id'],
            'edit_nama_rak' => ['required', 'string', 'max:100'],
            'edit_nomor_baris' => ['required', 'numeric']
        ];
    }

    public function attributes(): array
    {
        return [
            'edit_kategori_id' => 'Kategori',
            'edit_nama_rak' => 'Rak',
            'edit_nomor_baris' => 'Baris'
        ];
    }
}
