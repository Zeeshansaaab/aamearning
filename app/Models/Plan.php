<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'user_ref',
        'ptc_rate',
        'daily_limit',
        'ptc_per_click_ref',
        'ptc_per_click_ref_daily_limit',
        'ptc_per_click_ref_status',
        'sl_per_click_ref',
        'sl_per_click_ref_daily_limit',
        'sl_per_click_ref_status',
        'task_per_click_ref',
        'task_per_click_ref_daily_limit',
        'task_per_click_ref_status',
        'ca_ref_commission',
        'ca_per_day_limit',
        'ca_status',
        'channel_subscribe_dl',
        'status',
        'validity',
        'ref_level'
    ];
}
