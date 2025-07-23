<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kelas_id',
        'kode_anggota',
        'nisn',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'foto'
    ];

    protected $dates = ['deleted_at'];

    protected function casts(): array
    {
        return [
            'nisn' => 'string'
        ];
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function getNama()
    {
        $nama = explode(' ', $this->nama)[0];
        return $nama;
    }

    public function getFoto()
    {
        if ($this->foto == "") {
            return 'assets/img/avatars/avatar.png';
        }

        return 'storage/' . $this->foto;
    }
}
