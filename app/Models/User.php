<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * @param string|null $password
     */
    public function setPasswordAttribute(?string $password): void
    {
        if (!$password) {
            $this->attributes['password'] = null;
            return;
        }
        $this->attributes['password'] = Hash::needsRehash($password)
            ? Hash::make($password)
            : $password;
    }

    public function favoriteContents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class, 'user_content')->as('favorites');
    }
}
