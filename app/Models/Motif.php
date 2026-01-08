<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motif extends Model
{
    use HasFactory;
 
    protected $fillable = ['title', 'subtitle', 'image'];

    public function items()
    {
        return $this->hasMany(MotifItem::class)->orderBy('sort_order');
    }
}


