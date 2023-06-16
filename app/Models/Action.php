<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = [
        'image',
        'text',
        'active'
    ];

    public $timestamps = false;
}

