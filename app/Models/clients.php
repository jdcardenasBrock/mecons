<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\cotizacion;

class clients extends Model
{
    use HasFactory;
    protected $fillable= ['name','typeID','numID','direccion','telefono','margen','web','created_by','modified_by'];

    public static function searchById($value)
    {
        $data = DB::table('clients')
            ->where([
                ['numID', 'like', "%{$value}%"]
            ])
            ->get();
        return $data;
    }
    public static function searchByName($value)
    {
        $data = DB::table('clients')
            ->where([
                [DB::raw('name'), 'like', "%{$value}%"]
            ])
            ->get();

        return $data;
    }

    public function cotizacion()
    {
        return $this->belongsTo(cotizacion::class, 'client_id', 'id');
    }

    public function equipos()
    {
        return $this->hasMany(equipoCliente::class, 'id_cliente');
    }
}
