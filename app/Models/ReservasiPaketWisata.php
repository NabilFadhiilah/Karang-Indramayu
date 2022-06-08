<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiPaketWisata extends Model
{
    use HasFactory;
    protected $table = 'reservasi_paket_wisata';
    protected $fillable = [
        'id_user', 'id_paket_wisata', 'id_rekening', 'partisipan_reservasi', 'tgl_reservasi', 'tgl_pesan_reservasi', 'tgl_batas_pembayaran', 'status_reservasi', 'total_reservasi'
    ];
}
