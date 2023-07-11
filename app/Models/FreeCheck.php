<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FreeCheck extends Model
{
    protected $fillable = [
        'name',
        'active'
    ];

    public function checks(): HasMany
    {
        return $this->hasMany(Check::class)->where('active',1);
    }
}
