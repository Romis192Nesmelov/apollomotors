<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Content extends Model
{
//    use Sluggable;

    protected $fillable = [
        'slug',
        'head',
        'text'
    ];

//    public function sluggable(): array
//    {
//        return [
//            'slug' => [
//                'source' => 'head'
//            ]
//        ];
//    }

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class);
    }
}
