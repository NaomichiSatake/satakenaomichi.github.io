<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function categoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLiked()
    {
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }

    public function getUsersByPostId()
    {
        return $this->likes()
            ->with('user') // リレーションをロード
            ->get()
            ->pluck('user'); // userカラムのみを取得
    }

}
