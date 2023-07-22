<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubRepair extends Model
{
    protected $fillable = [
        'name',
        'price',
        'repair_id'
    ];

    public $timestamps = false;

    public function repair(): BelongsTo
    {
        return $this->belongsTo(Repair::class);
    }
}
