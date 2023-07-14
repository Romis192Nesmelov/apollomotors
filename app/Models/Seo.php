<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seo extends Model
{
    protected $fillable = [
        'title',
        'keywords',
        'description',
        'content_id',
//        'action_id',
        'article_id',

        'brand_repair_id',
        'car_repair_id',
        'brand_maintenance_id',
        'car_maintenance_id',
        'brand_spare_id',
        'car_spare_id',

        'repair_id',
        'spare_id',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

//    public function action(): BelongsTo
//    {
//        return $this->belongsTo(Action::class);
//    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function brandRepair(): BelongsTo
    {
        return $this->belongsTo(BrandRepair::class);
    }

    public function carRepair(): BelongsTo
    {
        return $this->belongsTo(CarRepair::class);
    }

    public function brandMaintenance(): BelongsTo
    {
        return $this->belongsTo(BrandMaintenance::class);
    }

    public function carMaintenance(): BelongsTo
    {
        return $this->belongsTo(CarMaintenance::class);
    }

    public function brandSpare(): BelongsTo
    {
        return $this->belongsTo(BrandSpare::class);
    }

    public function carSpare(): BelongsTo
    {
        return $this->belongsTo(CarSpare::class);
    }

    public function repair(): BelongsTo
    {
        return $this->belongsTo(Repair::class);
    }

    public function spare(): BelongsTo
    {
        return $this->belongsTo(Spare::class);
    }
}
