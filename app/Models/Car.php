<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'image_width',
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

    public function repair(): HasOne
    {
        return $this->hasOne(CarRepair::class);
    }

    public function maintenances(): HasOne
    {
        return $this->hasOne(CarMaintenance::class);
    }

    public function spare(): HasOne
    {
        return $this->hasOne(CarSpare::class);
    }

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class);
    }
}
