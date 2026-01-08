<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressArticle extends Model
{
    use HasFactory;

     protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category',
        'external_url',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];
    
}
