<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairImage extends Model
{
    protected $fillable = [
        'image',
        'preview',
        'repair_id'
    ];

    public $timestamps = false;

    public function repair(): BelongsTo
    {
        return $this->belongsTo(Repair::class);
    }
}
