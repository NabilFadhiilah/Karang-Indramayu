<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengembangan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengembangan';
    protected $fillable = [
        'id_pengembangan', 'id_user', 'id_rekening', 'pendanaan', 'bukti_pembayaran', 'tgl_investasi', 'tgl_batas_pembayaran', 'status', 'tgl_verifikasi'
    ];

    public function relationToRekening()
    {
        # code...
        return $this->hasMany(Rekening::class, 'id', 'id_rekening');
    }

    public function relationToWisata()
    {
        # code...
        return $this->hasMany(Wisata::class, 'id', 'id_wisata');
    }

    public function relationToPengembangan()
    {
        # code...
        return $this->hasMany(PengembanganWisata::class, 'id', 'id_pengembangan');
    }

    public function relationToUser()
    {
        # code...
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
