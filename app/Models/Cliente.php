<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre_apellidos',
        'documento_identidad',
        'fecha_nacimiento',
        'domicilio',
        'codigo_postal',
        'municipio',
        'municipio_nombre',
        'provincia',
        'provincia_nombre',
        'telefono',
        'email',
        'deleted_at'
    ];

}