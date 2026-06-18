<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
    'name',
    'slug',
    'price',
    'duration_days',
    'businesses_limit',
    'jobs_limit',
    'images_limit',
    'can_feature_business',
    'status',
];

public function subscriptions()
{
    return $this->hasMany(Subscription::class);
}
}
