<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Admin extends Model
{
    use HasFactory;


    public function encryptId($id){
        $encryptedId = Crypt::encrypt($id);
        return $encryptedId;
    }

    public function decryptId($id){
        $decryptedId = Crypt::decrypt($id);
        return $decryptedId;
    }
}
