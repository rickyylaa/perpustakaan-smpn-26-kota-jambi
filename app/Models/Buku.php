<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'rak_baris_id',
        'isbn',
        'judul',
        'slug',
        'kategori',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'jumlah_eksemplar',
        'deskripsi',
        'cover'
    ];

    protected $dates = ['deleted_at'];

    public function rak_baris()
    {
        return $this->belongsTo(RakBaris::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function getCover()
    {
        $covers = json_decode($this->cover, true);

        if (empty($covers) || !is_array($covers)) {
            return asset('assets/img/cover/default.png');
        }

        return asset('storage/' . $covers[0]);
    }
}
