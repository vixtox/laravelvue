<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = [
        'provincia',
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'provincia_id');
    }

}
