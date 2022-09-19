<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

    public function media()
    {
        return $this->morphOne(Media::class, 'model');
    }

    public function single_currency()
    {
        return $this->hasOne(GatewayCurrency::class, 'method_code', 'code')->latest();
    }

    public function scopeCrypto()
    {
        return $this->crypto == 1 ? 'crypto' : 'fiat';
    }

    public function scopeAutomatic()
    {
        return $this->where('code', '<', 1000);
    }

    public function scopeManual()
    {
        return $this->where('is_manual', 1);
    }
}
