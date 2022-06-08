<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wisata extends Model
{
    // use Sluggable;
    use HasFactory, SoftDeletes;

    protected $table = 'wisata';
    protected $fillable = [
        'nama_wisata', 'slug', 'deskripsi', 'durasi_wisata', 'harga', 'ketentuan', 'tgl_reservasi_awal', 'tgl_reservasi_akhir', 'status_wisata'
    ];

    public function relationToGallery()
    {
        # code...
        return $this->hasMany(Gallery::class, 'id_wisata', 'id');
    }

    public function relationToPaket()
    {
        # code...
        return $this->belongsToMany(Paket::class);
    }
}
