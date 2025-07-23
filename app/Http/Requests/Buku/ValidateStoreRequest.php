<?php

namespace App\Http\Requests\Buku;

use App\Rules\UniqueISBN;
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
            'tambah_rak_baris_id' => ['required', 'exists:rak_baris,id'],
            'tambah_kategori' => ['required', 'exists:kategoris,id'],
            'tambah_isbn' => ['nullable', 'numeric', 'digits_between:10,13', new UniqueISBN()],
            'tambah_judul' => ['required', 'string', 'max:100'],
            'tambah_pengarang' => ['required', 'string', 'max:100'],
            'tambah_penerbit' => ['nullable', 'string', 'max:100'],
            'tambah_tahun_terbit' => ['nullable', 'digits:4', 'numeric'],
            'tambah_jumlah_eksemplar' => ['required', 'numeric'],
            'tambah_deskripsi' => ['nullable', 'string'],
            'tambah_cover' => ['nullable', 'array'],
            'tambah_cover.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048']
        ];
    }

    public function attributes(): array
    {
        return [
            'tambah_rak_baris_id' => 'Rak & Baris',
            'tambah_kategori' => 'Kategori',
            'tambah_isbn' => 'ISBN',
            'tambah_judul' => 'Judul',
            'tambah_pengarang' => 'Pengarang',
            'tambah_penerbit' => 'Penerbit',
            'tambah_tahun_terbit' => 'Tahun Terbit',
            'tambah_jumlah_eksemplar' => 'Jumlah Eksemplar',
            'tambah_deskripsi' => 'Deskripsi',
            'tambah_cover' => 'Cover'
        ];
    }
}
