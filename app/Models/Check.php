<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Check extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active',
        'free_check_id',
    ];

    public function freeCheck(): BelongsTo
    {
        return $this->belongsTo(FreeCheck::class);
    }
}
