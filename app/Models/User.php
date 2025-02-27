<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;

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

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function posts(){
        return $this->hasMany(Post::class)->latest();
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }


    public function followers(){

        // to get all the followers of the user
        // based on the following_id and returns the follower_id users
        return $this->hasMany(Follow::class,'following_id');
    }

    // to get the users that the user is following
    //based on the follower_id and returns the following_id users
    public function following(){
        return $this->hasMany(Follow::class,'follower_id');
    }

    public function isFollowed(){
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
    }







}
