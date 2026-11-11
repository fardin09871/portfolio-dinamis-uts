<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutFocusArea extends Model
{
    protected $fillable = [
        'about_profile_id',
        'title',
        'description',
        'sort_order',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(AboutProfile::class, 'about_profile_id');
    }
}