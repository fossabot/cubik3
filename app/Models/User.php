<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be appended for arrays.
     *
     * @var array
     */
    protected $appends = [
        'gravatar',
    ];

    public function getGravatarAttribute()
    {
        $hash = md5($this->email);
        return "https://www.gravatar.com/avatar/$hash";
    }

    /**
     * The posts created by the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * The users this user is following.
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'user_follows', 'user_id', 'followed_user_id');
    }

    /**
     * The users following this user.
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follows', 'followed_user_id', 'user_id');
    }

    /**
     * Hide any attributes that should be private.
     */
    public function hidePrivateAttributes()
    {
        return $this->makeHidden([
            'email', 'email_verified_at', 'created_at', 'updated_at',
        ]);
    }
}
