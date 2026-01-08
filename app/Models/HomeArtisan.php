<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeArtisan extends Model
{
    use HasFactory;
     protected $fillable = [
        'job',
        'description',
        'location',
        'avatar',
        'rating',
        'experience',
        'status',
        'order',
        'is_active',
    ];
}
 