<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazaPerro extends Model
{
    use HasFactory;

    protected $fillable = [
        'raza',
    ];
    
    public function especie()
    {
        return $this->belongsTo(Especie::class, 'especie_id');
    }
}
