<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_wisata', 'image'
    ];

    protected $table = 'gallery';

    public function relationToWisata()
    {
        # code...
        return $this->belongsTo(Wisata::class, 'id_wisata', 'id');
    }
}
