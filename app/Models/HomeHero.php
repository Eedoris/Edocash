<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeHero extends Model
{
    use HasFactory;

    protected $table = 'home_heroes';

    protected $fillable = [
        'background_image',
        'title_before',
        'title_after',
        'jobs',
        'subtitle',
        'cta_text',
        'cta_link',
    ];

    protected $casts = [
        'jobs' => 'array',
    ];

    public function histories()
    {
        return $this->hasMany(HomeHeroHistory::class);
    }

    protected static function booted()
    {
        static::updated(function (HomeHero $hero) {
            if ($hero->wasChanged()) {
                $hero->histories()->create([
                    'data' => collect($hero->getAttributes())
                        ->except(['id', 'created_at', 'updated_at'])
                        ->toArray(),

                    'modified_by' => auth()->user()->name ?? 'Admin',
                ]);
            }
        });
    }
}
