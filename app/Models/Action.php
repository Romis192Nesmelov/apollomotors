<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Action extends Model
{
    use Sluggable;

    protected $fillable = [
        'image',
        'image_small',
        'slug',
        'head',
        'text',
        'limit',
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

    public $timestamps = false;

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(ActionQuestion::class);
    }

    public function brand(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class);
    }
}

