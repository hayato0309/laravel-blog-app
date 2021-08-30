<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'avatar', 'email', 'password', 'greeting', 'interests',
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function follows()
    {
        return $this->belongsToMany(Follow::class);
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id'); // LaravelのNaming conventionに沿っていないため、第2~4の引数が必要。
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id'); // LaravelのNaming conventionに沿っていないため、第2~4の引数が必要。
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
}
