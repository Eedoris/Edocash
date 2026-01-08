<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeHeroHistory extends Model
{
    protected $table = 'home_hero_histories';

    protected $fillable = [
        'home_hero_id',
        'data',
        'modified_by',
        'created_at',
    ];

    protected $casts = [
        'data' => 'array',
        'created_at' => 'datetime',
    ];

    public function homeHero()
    {
        return $this->belongsTo(HomeHero::class);
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('d/m/Y à H:i');
    }

    /**
     * Récupérer une valeur spécifique depuis les données
     */
    public function getDataValue(string $key, $default = null)
    {
        $value = $this->data[$key] ?? $default;
        
        // Pour la clé 'jobs', toujours retourner un tableau
        if ($key === 'jobs') {
            if (is_string($value)) {
                return json_decode($value, true) ?? [];
            }
            return is_array($value) ? $value : [];
        }
        
        return $value;
    }
}