<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'wali_kelas',
        'isi_kelas'
    ];

    protected $dates = ['deleted_at'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
