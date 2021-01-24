<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanysProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo', 'about', 'visi', 'misi'
    ];
}
