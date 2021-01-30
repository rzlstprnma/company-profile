<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name'
    ];

    public function Post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
