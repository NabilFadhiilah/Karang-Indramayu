<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiWisata extends Model
{
    use HasFactory;
    protected $table = 'reservasi_wisata';
    protected $fillable = [
        'id_user', 'id_wisata', 'id_rekening', 'partisipan_reservasi', 'tgl_reservasi', 'tgl_pesan_reservasi', 'tgl_batas_pembayaran', 'status_reservasi', 'total_reservasi'
    ];
}
