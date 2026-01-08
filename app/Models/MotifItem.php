<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MotifItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'motif_id',
        'title',
        'description',
        'sort_order',
    ];

    public function motif()
    {
        return $this->belongsTo(Motif::class);
    }
}

