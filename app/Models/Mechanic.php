<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mechanic extends Model
{
    protected $fillable = ['id','name','active'];

        public function missingMechanics(): BelongsToMany
    {
        return $this->belongsToMany(MissingMechanic::class);
    }
}
