<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Repair extends Model
{
    use Sluggable;

    protected $fillable = [
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

    public function recommendedWorks(): BelongsToMany
    {
        return $this->belongsToMany(RecommendedWork::class,'repairs');
    }

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class);
    }
}
