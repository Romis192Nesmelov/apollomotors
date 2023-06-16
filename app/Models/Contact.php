<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'icon',
        'contact',
        'type',
        'active'
    ];

    public $timestamps = false;
}
