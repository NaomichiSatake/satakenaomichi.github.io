<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;
    // this is to inform laravel to use category_post instead of category_posts
    protected $table = 'category_post';

    // to allow mass creation of data to the database
    protected $fillable = ['category_id','post_id'];

    // disable timestamps
    public $timestamps = false;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function post(){
        return $this->belongsTo(Post::class)->withTrashed();
    }
}
