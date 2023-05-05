<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_mascota',
        'fecha',
        'tipo',
        'archivo',
        'deleted_at'
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota', 'id');
    }

}
