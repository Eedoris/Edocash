<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PressSectionItem extends Model
{
    protected $fillable = [
        'quote',
        'source',
        'media_logo',
        'published_at',
        'sort_order',
        'external_url',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];
}
