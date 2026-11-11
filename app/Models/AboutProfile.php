<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AboutProfile extends Model
{
    protected $fillable = [
        'name',
        'full_name',
        'role',
        'profile_label',
        'image_path',
        'quote',
        'est_year',
        'universe_code',
    ];

    public function descriptions(): HasMany
    {
        return $this->hasMany(AboutDescription::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function focusAreas(): HasMany
    {
        return $this->hasMany(AboutFocusArea::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }
}
