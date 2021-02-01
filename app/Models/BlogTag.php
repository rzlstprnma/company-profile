<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'tag_name'
    ];

    public function posts()
    {
        return $this->belongsToMany('App\Models\BlogPost', 'blog_post_tags', 'blog_tag_id', 'blog_post_id');
    }
}
