<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CarRepair extends Model
{
    protected $fillable = [
        'text',
        'car_id'
    ];

    public $timestamps = false;

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class);
    }
}
