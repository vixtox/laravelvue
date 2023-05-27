<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fecha',
        'tipo',
        'archivo',
        'mascotas_id',
        'deleted_at'
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascotas_id', 'id');
    }

}
