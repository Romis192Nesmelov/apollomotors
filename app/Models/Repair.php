<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Repair extends Model
{
    use Sluggable;

    protected $fillable = [
        'id',
        'slug',
        'price',
        'old_price',
        'price_from',
        'work_time',
        'upon_reaching_years',
        'upon_reaching_mileage',
        'upon_reaching_conditions',
        'free_diagnostics',
        'warranty_years',
        'head',
        'text',
        'spares_image',
        'car_id',
        'active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'head'
            ]
        ];
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function recommendedWorks(): HasMany
    {
        return $this->hasMany(RecommendedWork::class,'repair_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(RepairImage::class);
    }

    public function subRepairs(): HasMany
    {
        return $this->hasMany(SubRepair::class);
    }

    public function spares(): BelongsToMany
    {
        return $this->belongsToMany(Spare::class)->orderBy('head');
    }

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class);
    }
}
