<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rekening extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rekening';
    protected $fillable = [
        'no_rekening', 'bank_rekening', 'pemilik_rekening'
    ];
}
