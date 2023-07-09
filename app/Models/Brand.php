<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

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

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function prices()
    {
        return $this->hasMany(HomePrice::class);
    }

    public function repair()
    {
        return $this->hasOne(BrandRepair::class);
    }

    public function maintenances()
    {
        return $this->hasMany(BrandMaintenance::class);
    }

    public function spare()
    {
        return $this->hasOne(BrandSpare::class);
    }

    public $timestamps = false;
}
