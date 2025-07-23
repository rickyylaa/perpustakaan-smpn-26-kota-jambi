<?php

namespace App\Http\Requests\Kelas;

use App\Rules\UniqueNoHp;
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
            'edit_nama_kelas' => ['required', 'max:100', new UniqueNoHp($bukuId)],
            'edit_tingkat' => ['required', 'numeric'],
            'edit_wali_kelas' => ['required', 'string', 'max:100']
        ];
    }

    public function attributes(): array
    {
        return [
            'edit_nama_kelas' => 'Nama Kelas',
            'edit_tingkat' => 'Tingkat',
            'edit_wali_kelas' => 'Wali Kelas'
        ];
    }
}
