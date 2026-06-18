<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    
protected $fillable = [
    'name',
    'slug',
    'status',
];

public function businesses()
{
    return $this->hasMany(Business::class);
}

public function jobs()
{
    return $this->hasMany(Job::class);
}
}
