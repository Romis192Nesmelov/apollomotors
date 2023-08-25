<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActionBrand extends Model
{
    protected $table = 'action_brand';

    protected $fillable = [
        'action_id',
        'brand_id'
    ];

    public $timestamps = false;

    public function action(): BelongsTo
    {
        return $this->belongsTo(Action::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
