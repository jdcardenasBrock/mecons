<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nombre_modelos extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'modelo_id'];

    public function modelo()
    {
        return $this->belongsTo(modelos::class, 'modelo_id'); // Especifica la clave foránea
    }
}
