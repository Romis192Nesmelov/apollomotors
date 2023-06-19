<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeCheck extends Model
{
    protected $fillable = [
        'name',
        'active'
    ];

    public function checks()
    {
        return $this->hasMany(Check::class)->where('active',1);
    }
}
