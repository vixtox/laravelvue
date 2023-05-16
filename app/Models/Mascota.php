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
        'capa',
        'caracter',
        'sexo',
        'estado',
        'fecha_nacimiento',
        'fecha_baja',
        'causa_baja',
        'deleted_at',
        'cliente_id',
        'especie_id',
        'razas_id',
    ];
    
    public function especie()
    {
        return $this->belongsTo(Especie::class, 'especie_id');
    }
    
    public function raza()
    {
        return $this->belongsTo(Raza::class, 'razas_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

}
