<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Spare extends Model
{
    use Sluggable;

    protected $fillable = [
        'id',
        'slug',
        'code',
        'price_original',
        'price_original_from',
        'price_non_original',
        'price_non_original_from',
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

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class);
    }

    public function repairs(): BelongsToMany
    {
        return $this->belongsToMany(Repair::class);
    }
}
