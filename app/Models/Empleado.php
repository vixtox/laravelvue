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
        'municipio',
        'provincia',
        'telefono',
        'email',
        'fecha_contratacion',
        'salario',
        'cargo',
        'deleted_at'
    ];

}
