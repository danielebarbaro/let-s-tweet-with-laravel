<?php

namespace App\Models;

use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use  SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * Set a password hashed
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Get the route key for the model.
     * @codeCoverageIgnore
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function latestTweets()
    {
        return $this->tweets()->latest();
    }

    public function tweet($tweet)
    {
        $this->tweets()->create($tweet);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id')->withTimestamps();
    }

    public function follows($user)
    {
        return $this->following()->where('following_id', $user->id)->count() > 0;
    }

    public function follow($user)
    {
        if ($this->follows($user)) {
            return;
        }
        $this->following()->attach($user);
    }

    public function unfollow($user)
    {
        if (!$this->follows($user)) {
            return;
        }
        $this->following()->detach($user);
    }

    public function notFollowing()
    {
        $following_ids = $this->following()->pluck('following_id')->push($this->id);
        return User::whereNotIn('id', $following_ids);
    }
}
