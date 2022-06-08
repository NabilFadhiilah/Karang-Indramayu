<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengembanganWisata extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengembangan_wisata';
    protected $fillable = ['id_wisata', 'target_dana'];

    public function relationToWisata()
    {
        # code...
        return $this->hasMany(Wisata::class, 'id', 'id_wisata');
    }
}
