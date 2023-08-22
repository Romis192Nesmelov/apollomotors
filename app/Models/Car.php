<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Car extends Model
{
    use Sluggable;

    protected $fillable = [
        'slug',
        'name_en',
        'name_ru',
        'image_full',
        'image_preview',
        'brand_id',
        'active',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }

    public $timestamps = false;

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function repairs(): HasMany
    {
        return $this->hasMany(CarRepair::class);
    }

    public function priceRepairs(): HasMany
    {
        return $this->hasMany(Repair::class)->orderBy('head');
    }

    public function maintenance(): HasOne
    {
        return $this->hasOne(CarMaintenance::class);
    }

    public function spare(): HasOne
    {
        return $this->hasOne(CarSpare::class);
    }

    public function spares(): HasMany
    {
        return $this->hasMany(Spare::class);
    }
}
