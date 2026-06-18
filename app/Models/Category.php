<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
protected $fillable = [
    'name',
    'slug',
    'image',
    'description',
    'status',
    'sort_order',
];

public function businesses()
{
    return $this->hasMany(Business::class);
}
}
