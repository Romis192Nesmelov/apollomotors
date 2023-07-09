<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarRepair extends Model
{
    protected $fillable = [
        'text',
        'car_id'
    ];

    public $timestamps = false;

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
