<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\providers;
use Illuminate\Support\Facades\DB;

class providers extends Model
{
    use HasFactory;
    protected $fillable= ['name','country','direction','email','phone','pageWeb','created_by','modified_by'];
    
    public static function searchById($value)
    {
        $data = DB::table('providers')
            ->where([
                ['id', 'like', "%{$value}%"]
            ])
            ->get();
        return $data;
    }
    public static function searchByName($value)
    {
        $data = DB::table('providers')
            ->where([
                [DB::raw('name'), 'like', "%{$value}%"]
            ])
            ->get();

        return $data;
    }
}
