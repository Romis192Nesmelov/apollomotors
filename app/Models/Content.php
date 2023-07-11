<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Content extends Model
{
    protected $fillable = [
        'head',
        'text'
    ];

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class);
    }
}
