<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
    'business_id',
    'plan_id',
    'starts_at',
    'ends_at',
    'status',
    'amount_paid',
    'payment_method',
    'payment_reference',
];

public function business()
{
    return $this->belongsTo(Business::class);
}

public function plan()
{
    return $this->belongsTo(Plan::class);
}
}
