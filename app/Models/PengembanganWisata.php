<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PengembanganWisata extends Model
{
    use HasFactory, SoftDeletes, HasRelationships;

    protected $table = 'pengembangan_wisata';
    protected $fillable = ['id_wisata', 'target_dana'];

    public function relationToWisata()
    {
        # code...
        return $this->hasMany(Wisata::class, 'id', 'id_wisata');
    }

    public function relationToGallery()
    {
        # code...
        return $this->HasMany(Gallery::class, 'id_wisata', 'id_wisata');
    }
}
