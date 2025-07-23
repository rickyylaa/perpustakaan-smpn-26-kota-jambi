<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Denda extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'denda_keterlambatan',
        'denda_buku_rusak',
        'denda_buku_hilang'
    ];

    protected $dates = ['deleted_at'];
}
