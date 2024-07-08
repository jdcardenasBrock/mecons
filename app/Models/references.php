<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class references extends Model
{

    use HasFactory;


    protected $fillable = [
        'main_id_reference',
        'name_reference',
        'weights_pounds', 'description', 'brand', 'notes'
    ];

    public static function ExistIdReference($idAsociar)
    {
        if (DB::table('references')->where('id_reference', $idAsociar)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}
