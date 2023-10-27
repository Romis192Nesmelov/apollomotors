<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DefCar extends Model
{
    protected $fillable = [
        'slug',
        'head',
        'text'
    ];

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class);
    }

    public function priceRepairs(): HasMany
    {
        return $this->hasMany(Repair::class)->orderBy('head');
    }

    public function priceRepairsActive(): HasMany
    {
        return $this->hasMany(Repair::class)->where('active',1)->orderBy('head');
    }
}
