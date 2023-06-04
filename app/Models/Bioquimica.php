<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Bioquimica extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'urea',
        'creatinina',
        'glucosa',
        'proteinas',
        'albumina',
        'bilirrubina',
        'alp',
        'gpt',
        'fosforo',
        'calcio',
        'colesterol',
        'trigliceridos',
        'lipidos',
        'cpk',
        'amilasa',
        'lipasa',
        'sodio',
        'potasio',
        'cloro',
        't4',
        'fecha',
        'animal',
        'mascotas_id',
        'visita_id'
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascotas_id');
    }

    public function visita()
    {
        return $this->belongsTo(Visita::class, 'visita_id');
    }

}
