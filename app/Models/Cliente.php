<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Municipio;
use App\Models\Provincia;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clientes';
    
    protected $fillable = [
        'nombre_apellidos',
        'documento_identidad',
        'fecha_nacimiento',
        'domicilio',
        'codigo_postal',
        'telefono',
        'email',
        'provincia_id',
        'municipio_id',
    ];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }
    
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

}
