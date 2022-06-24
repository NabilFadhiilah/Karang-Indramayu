<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaketWisata extends Model
{
    use HasFactory;

    protected $table = 'paket_wisata';
    protected $fillable = ['id_paket', 'id_wisata', 'hari'];
}
