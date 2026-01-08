<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle'];

    public function items()
    {
        return $this->hasMany(MotivationItem::class)->orderBy('sort_order');
    }
}
