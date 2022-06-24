<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiPaketWisata extends Model
{
    use HasFactory;
    protected $table = 'reservasi_paket_wisata';
    protected $fillable = [
        'id_user', 'id_paket_wisata', 'id_rekening', 'partisipan_reservasi', 'tgl_reservasi', 'tgl_pesan_reservasi', 'tgl_batas_pembayaran', 'bukti_reservasi', 'status_reservasi', 'total_reservasi'
    ];
    public function relationToPaket()
    {
        # code...
        return $this->hasMany(Paket::class, 'id', 'id_paket_wisata');
    }
    public function relationToGallery()
    {
        # code...
        return $this->hasMany(Gallery::class, 'id', 'id_wisata');
    }

    public function relationToWisata()
    {
        # code...
        return $this->hasMany(Wisata::class, 'id', 'id_wisata');
    }

    public function relationToRekening()
    {
        # code...
        return $this->hasMany(Rekening::class, 'id', 'id_rekening');
    }

    public function relationToUser()
    {
        # code...
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
