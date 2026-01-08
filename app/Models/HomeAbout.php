<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAbout extends Model
{
    use HasFactory;
    protected $fillable = [
        'badge',
        'title',
        'highlight',
        'intro',
        'cta_label',
        'cta_link',
    ];
}
