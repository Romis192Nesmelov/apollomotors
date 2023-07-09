<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

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

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function repair()
    {
        return $this->hasOne(CarRepair::class);
    }

    public function maintenances()
    {
        return $this->hasOne(CarMaintenance::class);
    }

    public function spare()
    {
        return $this->hasOne(CarSpare::class);
    }

    public $timestamps = false;
}
