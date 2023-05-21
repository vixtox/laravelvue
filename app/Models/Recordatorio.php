<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'mascotas_id', 
        'vacuna', 
        'fecha',
        'deleted_at'
    ];


    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota', 'id');
    }
}
