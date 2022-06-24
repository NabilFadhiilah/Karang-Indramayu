<?php

namespace App\Models;

use App\Models\Wisata;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


class Paket extends Model
{
    use HasFactory, HasRelationships;
    protected $table = 'paket';
    protected $fillable = ['nama_paket', 'slug', 'deskripsi', 'durasi_wisata', 'harga', 'ketentuan', 'tgl_reservasi_awal', 'tgl_reservasi_akhir', 'status_wisata'];

    public function relationToWisata()
    {
        # code...
        return $this->belongsToMany(Wisata::class, 'paket_wisata', 'id_paket', 'id_wisata');
    }

    public function relationToGallery()
    {
        # code...
        return $this->hasMany(Gallery::class, 'id_wisata', 'id');
    }

    public function relationToPaketWisata()
    {
        # code...
        return $this->HasManyDeep(Gallery::class, ['paket_wisata', Wisata::class], ['id_paket', 'id', 'id_wisata'], ['id', 'id_wisata', 'id']);
    }
}
