<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OldCar extends Model
{
    protected $fillable = [
        'slug',
        'eng',
        'rus',
        'full',
        'preview',
        'img_width',

        'repair',
        'maintenance',
        'spares',

        'title_repair',
        'title_maintenance',
        'title_spares',

        'keywords_repair',
        'keywords_maintenance',
        'keywords_spares',

        'description_repair',
        'description_maintenance',
        'description_spares',

        'brand_id',
        'active',
    ];
}
