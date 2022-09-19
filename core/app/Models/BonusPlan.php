<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'amount',
        'plan_id',
        'value',
        'status'
    ];
}
