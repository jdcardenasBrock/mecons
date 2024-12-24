<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelos extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'marca_id'];

    public function nombres()
    {
        return $this->hasMany(nombre_modelos::class, 'modelo_id');
    }

    public function marca()
    {
        return $this->belongsTo(marcas::class, 'marca_id'); // Especifica la clave foránea
    }
}
