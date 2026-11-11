<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'tech_stack',
        'github_url',
        'live_url',
        'featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
            'featured' => 'boolean',
        ];
    }
}
