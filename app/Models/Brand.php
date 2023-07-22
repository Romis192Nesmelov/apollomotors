<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Brand extends Model
{
    use Sluggable;

    protected $fillable = [
        'logo',
        'slug',
        'name_en',
        'name_ru',
        'maintenance_part1',
        'maintenance_part2',
        'spares',
        'elected',
        'active'
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

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class)->orderBy('name_'.app()->getLocale());
    }

    public function prices(): HasMany
    {
        return $this->hasMany(HomePrice::class);
    }

    public function repair(): HasOne
    {
        return $this->hasOne(BrandRepair::class);
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(BrandMaintenance::class);
    }

    public function spare(): HasOne
    {
        return $this->hasOne(BrandSpare::class);
    }

    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(Action::class);
    }
}
