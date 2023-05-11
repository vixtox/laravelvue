<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre_apellidos',
        'documento_identidad',
        'direccion',
        'pais',
        'codigo_postal',
        'id_municipio',
        'id_provincia',
        'telefono',
        'email',
        'fecha_contratacion',
        'salario',
        'cargo',
        'deleted_at'
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
