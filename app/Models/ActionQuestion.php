<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActionQuestion extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'active',
        'action_id'
    ];

    public $timestamps = false;

    public function action(): BelongsTo
    {
        return $this->belongsTo(Action::class);
    }
}
