<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job_listings';

protected $fillable = [
    'business_id',
    'area_id',
    'title',
    'slug',
    'description',
    'requirements',
    'employment_type',
    'workplace_type',
    'salary_min',
    'salary_max',
    'salary_currency',
    'experience_level',
    'image',
    'expires_at',
    'views_count',
    'applications_count',
    'status',
    'rejection_reason',
];

public function business()
{
    return $this->belongsTo(Business::class);
}

public function area()
{
    return $this->belongsTo(Area::class);
}

public function applications()
{
    return $this->hasMany(JobApplication::class);
}
}
