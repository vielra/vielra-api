<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'photo_url',
        'avatar_text_color',
        'mobile_phone',
        'gender',
        'about',
        'birthday',
        'status',
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     *
     * @var array
     */
    protected $attributes = [
        'status'    => "active",
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['social_account'];

    /**
     * Relationship between User and SocialAccount
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function social_account()
    {
        return $this->hasOne(SocialAccount::class);
    }
}
