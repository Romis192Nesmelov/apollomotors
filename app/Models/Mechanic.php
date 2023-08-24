<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mechanic extends Model
{
    protected $fillable = ['id','name','active'];

    public function missing(): HasMany
    {
        return $this->hasMany(MissingMechanic::class);
    }
}
