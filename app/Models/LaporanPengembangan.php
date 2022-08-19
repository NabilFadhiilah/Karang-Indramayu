<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPengembangan extends Model
{
    use HasFactory;
    protected $table = 'lap_pengembangan';
    protected $fillable = ['id_pengembangan', 'pengeluaran', 'biaya_pengeluaran', 'tgl_pengeluaran', 'ket_pengeluaran'];
}
