<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBonus extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bonus_plan_id', 'status'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function bonusplan()
    {
        return $this->belongsTo(BonusPlan::class, 'bonus_plan_id');
    }
}
