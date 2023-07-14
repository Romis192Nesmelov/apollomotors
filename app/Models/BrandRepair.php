<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BrandRepair extends Model
{
    protected $fillable = [
        'text',
        'brand_id'
    ];

    public $timestamps = false;

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class);
    }
}
