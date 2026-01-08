<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PressSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'intro',
        'video_url',
        'video_title',
    ];

    public function items()
    {
        return $this->hasMany(PressSectionItem::class)
            ->orderBy('sort_order');
    }
}

