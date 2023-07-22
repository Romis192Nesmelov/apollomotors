<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairSpare extends Model
{
    protected $table = 'repair_spare';

    protected $fillable = [
        'repair_id',
        'spare_id'
    ];

    public $timestamps = false;

    public function repair()
    {
        return $this->belongsTo(Repair::class,'repair_id');
    }

    public function spare()
    {
        return $this->belongsTo(Spare::class,'spare_id');
    }
}
