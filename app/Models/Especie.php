<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    use HasFactory;

    protected $fillable = [
        'especie',
    ];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'especie_id');
    }
}
