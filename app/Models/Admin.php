<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'no_hp',
        'jenis_kelamin',
        'foto'
    ];

    protected $dates = ['deleted_at'];

    protected function casts(): array
    {
        return [
            'nip' => 'string'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
