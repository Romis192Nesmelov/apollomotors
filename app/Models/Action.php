<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Action extends Model
{
    protected $fillable = [
        'image',
        'image_small',
        'text',
        'limit',
        'active'
    ];

    public $timestamps = false;

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class);
    }
}

