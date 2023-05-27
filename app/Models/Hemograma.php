<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Hemograma extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hematocrito',
        'hemoglobina',
        'g_rojo',
        'vcm',
        'hcm',
        'chcm',
        'reticulocitos',
        'eosinofilos',
        'linfocitos',
        'monocitos',
        'leucocitos',
        'plaquetas',
        'fecha',
        'animal',
        'mascotas_id',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascotas_id');
    }

}
