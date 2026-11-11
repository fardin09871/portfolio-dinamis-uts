<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutDescription extends Model
{
    protected $fillable = [
        'about_profile_id',
        'content',
        'sort_order',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(AboutProfile::class, 'about_profile_id');
    }
}