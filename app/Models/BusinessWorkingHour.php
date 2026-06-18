<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessWorkingHour extends Model
{
    protected $fillable = [
    'business_id',
    'day_of_week',
    'opens_at',
    'closes_at',
    'is_closed',
];

public function business()
{
    return $this->belongsTo(Business::class);
}
}
