<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPaket extends Model
{
    use HasFactory;
    protected $table = 'lap_paket_wisata';
    protected $fillable = ['id_reservasi_paket', 'pengeluaran', 'biaya_pengeluaran'];

    public function relationToReservasi()
    {
        # code...
        return $this->hasMany(ReservasiPaketWisata::class, 'id', 'id_reservasi_paket');
    }
}
