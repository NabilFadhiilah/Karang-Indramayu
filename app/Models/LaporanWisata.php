<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanWisata extends Model
{
    use HasFactory;
    protected $table = 'lap_wisata';
    protected $fillable = ['id_reservasi_wisata', 'pengeluaran', 'biaya_pengeluaran'];
}
