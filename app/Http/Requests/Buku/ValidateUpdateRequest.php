<?php

namespace App\Http\Requests\Buku;

use App\Rules\UniqueISBN;
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
        $bukuId = $this->route('buku')?->id;

        return [
            'edit_rak_baris_id' => ['required', 'exists:rak_baris,id'],
            'edit_kategori' => ['required', 'exists:kategoris,id'],
            'edit_isbn' => ['nullable', 'numeric', 'digits_between:10,13', new UniqueISBN($bukuId)],
            'edit_judul' => ['required', 'string', 'max:100'],
            'edit_pengarang' => ['required', 'string', 'max:100'],
            'edit_penerbit' => ['nullable', 'string', 'max:100'],
            'edit_tahun_terbit' => ['nullable', 'digits:4', 'numeric'],
            'edit_jumlah_eksemplar' => ['required', 'numeric'],
            'edit_deskripsi' => ['nullable', 'string'],
            'edit_cover' => ['nullable', 'array'],
            'edit_cover.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048']
        ];
    }

    public function attributes(): array
    {
        return [
            'edit_rak_baris_id' => 'Rak & Baris',
            'edit_kategori' => 'Kategori',
            'edit_isbn' => 'ISBN',
            'edit_judul' => 'Judul',
            'edit_pengarang' => 'Pengarang',
            'edit_penerbit' => 'Penerbit',
            'edit_tahun_terbit' => 'Tahun Terbit',
            'edit_jumlah_eksemplar' => 'Jumlah Eksemplar',
            'edit_deskripsi' => 'Deskripsi',
            'edit_cover' => 'Cover'
        ];
    }
}
