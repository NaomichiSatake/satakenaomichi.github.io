<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    public $timestamps = false;

    public function follower(){
        return $this->belongsTo(User::class, 'follower_id')->withTrashed();
    }

 //to ge tthe info of the user being followed
    public function following(){
        return $this->belongsTo(User::class,'following_id')->withTrashed();
    }





}
