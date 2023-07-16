<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecommendedWork extends Model
{
    protected $fillable = [
        'repair_id',
        'work_id'
    ];

    public $timestamps = false;

    public function repair(): BelongsTo
    {
        return $this->belongsTo(Repair::class,'repair_id');
    }

    public function work(): BelongsTo
    {
        return $this->belongsTo(Repair::class,'work_id');
    }
}
