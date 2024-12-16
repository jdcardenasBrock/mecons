<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable=['id','taskName','startDate','expyreDate','durationDays',
    'current_status','extendedDate', 'notes','id_asesor','id_contact',
    'id_qoute', 'id_cliente','created_by'];
}
