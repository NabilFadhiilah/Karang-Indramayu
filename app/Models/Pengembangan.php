<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengembangan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengembangan';
    protected $fillable = [
        'id_pengembangan', 'id_user', 'id_rekening', 'pendanaan', 'status'
    ];
}
