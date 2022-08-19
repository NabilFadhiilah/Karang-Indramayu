<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wisata extends Model
{
    // use Sluggable;
    use HasFactory;

    protected $table = 'wisata';
    protected $fillable = [
        'nama_wisata', 'slug', 'deskripsi', 'durasi_wisata', 'harga', 'ketentuan', 'tgl_reservasi_awal', 'tgl_reservasi_akhir', 'status_wisata'
    ];

    public function relationToGallery()
    {
        # code...
        return $this->hasMany(Gallery::class, 'id_wisata', 'id');
        // return $this->hasOne(Gallery::class, 'id_wisata', 'id');
    }

    public function relationToPengembangan()
    {
        # code...
        return $this->hasMany(PengembanganWisata::class, 'id_wisata', 'id');
    }

    public function relationToPaket()
    {
        # code...
        return $this->belongsToMany(Paket::class);
    }

    public function relationThroughPengembangan()
    {
        # code...
        return $this->hasManyThrough(Pengembangan::class, PengembanganWisata::class, 'id_wisata', 'id_pengembangan');
    }

    public function relationToTransaction()
    {
        # code...
        return $this->hasMany(ReservasiWisata::class, 'id_wisata', 'id');
    }

    public function relationToLaporan()
    {
        # code...
        return $this->hasManyThrough(LaporanPengembangan::class, PengembanganWisata::class, 'id_wisata', 'id_pengembangan');
    }
}
