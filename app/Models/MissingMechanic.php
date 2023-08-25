<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MissingMechanic extends Model
{
    protected $fillable = ['date'];

    public function mechanics(): BelongsToMany
    {
        return $this->belongsToMany(Mechanic::class);
    }
}
