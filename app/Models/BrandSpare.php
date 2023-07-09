<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandSpare extends Model
{
    protected $fillable = [
        'text',
        'brand_id'
    ];

    public $timestamps = false;

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
