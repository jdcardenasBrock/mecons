<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marcas extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    public function modelos()
    {
        return $this->hasMany(modelos::class, 'marca_id'); // Especifica la clave foránea
    }
    public function equipos()
    {
        return $this->hasMany(equipoCliente::class, 'marca', 'id');
    }
}
