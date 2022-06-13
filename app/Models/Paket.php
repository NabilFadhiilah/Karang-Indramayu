<?php

namespace App\Models;

use App\Models\Wisata;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'paket';
    protected $fillable = ['nama_paket', 'slug', 'deskripsi', 'durasi_wisata', 'harga', 'ketentuan', 'tgl_reservasi_awal', 'tgl_reservasi_akhir', 'status_wisata'];

    public function relationToWisata()
    {
        # code...
        return $this->belongsToMany(Wisata::class, 'paket_wisata', 'id_paket', 'id_wisata');
    }
}
