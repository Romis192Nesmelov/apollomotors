<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Brand extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'elected',
        'active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function prices()
    {
        return $this->hasMany(HomePrice::class)->where('active',1);
    }

    public $timestamps = false;
}
