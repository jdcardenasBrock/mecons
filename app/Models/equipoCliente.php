<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Models\clients;

class equipoCliente extends Model
{
    use HasFactory;
    protected $fillable=['marca','nombre_modelo','modelo','serial','numero_interno','ubicacion','id_cliente'];
   
    public function client()
    {
        return $this->belongsTo(clients::class, 'id');
    }
}
