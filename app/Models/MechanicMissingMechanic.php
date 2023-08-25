<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MechanicMissingMechanic extends Model
{
    protected $table = 'mechanic_missing_mechanic';

    protected $fillable = [
        'mechanic_id',
        'missing_mechanic_id'
    ];

    public $timestamps = false;

    public function mechanic(): BelongsTo
    {
        return $this->belongsTo(Mechanic::class);
    }

    public function missingMechanic(): BelongsTo
    {
        return $this->belongsTo(MissingMechanic::class);
    }
}
