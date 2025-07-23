<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'peminjamans';

    protected $fillable = [
        'siswa_id',
        'tanggal_pinjam',
        'tanggal_deadline',
        'status'
    ];

    protected $dates = ['deleted_at'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatPeminjaman::class);
    }
}
