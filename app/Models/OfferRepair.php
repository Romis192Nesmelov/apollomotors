<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferRepair extends Model
{
    protected $fillable = [
        'name',
        'image',
        'active'
    ];
}
