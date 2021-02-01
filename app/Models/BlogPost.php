<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'category_id', 'photo', 'title', 'body'
    ];

    public function category()
    {
        return $this->hasOne('App\Models\BlogCategory', 'id', 'category_id')->select(["id", "category_name"]);
    }
    
    public function blog_tags()
    {
        return $this->belongsToMany('App\Models\BlogTag', 'blog_post_tags', 'blog_post_id', 'blog_tag_id');
    }
}
