<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatPeminjaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'riwayat_peminjamans';

    protected $fillable = [
        'peminjaman_id',
        'buku_id',
        'tanggal_kembali',
        'denda_keterlambatan',
        'denda_buku_rusak',
        'denda_buku_hilang',
        'catatan',
        'status'
    ];

    protected $dates = ['deleted_at'];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class)->withTrashed();
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
