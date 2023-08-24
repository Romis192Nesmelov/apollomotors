<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model
{
    protected $fillable = [
        'car',
        'title',
        'name',
        'email',
        'phone',
        'status',
        'point',
        'date',
        'time',
        'duration',
        'send_notice',
        'sent_notice',
        'car_id',
        'user_id',
    ];

    public function carLink(): BelongsTo
    {
        return $this->belongsTo(Car::class,'car_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
