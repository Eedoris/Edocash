<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivationItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'author',
        'published_at',
        'sort_order',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];
     public function section()
    {
        return $this->belongsTo(Motivation::class);
    }
}

