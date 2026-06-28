<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'owner_id',
        'category_id',
        'area_id',
        'name',
        'slug',
        'description',
        'phone',
        'whatsapp',
        'email',
        'website',
        'address',
        'latitude',
        'longitude',
        'logo',
        'cover',
        'price_level',
        'is_open',
        'has_delivery',
        'family_friendly',
        'is_featured',
        'rating_avg',
        'reviews_count',
        'views_count',
        'status',
        'rejection_reason',
    ];

    public function getTitleAttribute(): ?string
    {
        return $this->name;
    }

    public function getAvgRatingAttribute(): ?float
    {
        return $this->rating_avg;
    }

    public function getImageAttribute(): ?string
    {
        return $this->cover;
    }

    public function getCoverImageAttribute(): ?string
    {
        return $this->cover;
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function images()
    {
        return $this->hasMany(BusinessImage::class);
    }

    public function services()
    {
        return $this->hasMany(BusinessService::class);
    }

    public function workingHours()
    {
        return $this->hasMany(BusinessWorkingHour::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }
}
