<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'contract_number', 'invoice_number', 'start_date', 'estimated_end_date', 'engineer_in_charge', 'architect_in_charge', 'total_value', 'total_cost', 'profit', 'margin',
    ];

    public function costs()
    {
        return $this->hasMany(Cost::class);
    }
}
