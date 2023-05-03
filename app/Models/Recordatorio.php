<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_mascota', 
        'vacuna', 
        'fecha'
    ];


    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota', 'id');
    }
}
