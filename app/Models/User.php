<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'name',
    'email',
    'phone',
    'password',
    'type',
    'status',
    'avatar',
    'email_verified_at',
    'phone_verified_at',
    'last_login_at',
];


public function businesses()
{
    return $this->hasMany(Business::class, 'owner_id');
}

public function reviews()
{
    return $this->hasMany(Review::class);
}

public function favorites()
{
    return $this->hasMany(Favorite::class);
}

public function jobApplications()
{
    return $this->hasMany(JobApplication::class);
}

public function reports()
{
    return $this->hasMany(Report::class);
}

public function searchLogs()
{
    return $this->hasMany(SearchLog::class);
}
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
