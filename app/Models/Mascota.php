<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'chip',
        'especie',
        'raza',
        'capa',
        'caracter',
        'sexo',
        'estado',
        'peso',
        'fecha_nacimiento',
        'fecha_alta',
        'fecha_baja',
        'causa_baja',
        'deleted_at'
    ];
    
    public function especie()
    {
        return $this->belongsTo(Especie::class, 'especie_id');
    }
    
    public function raza__perro()
    {
        return $this->belongsTo(Municipio::class, 'raza_perro_id');
    }

}
