<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactProfile extends Model
{
    protected $fillable = [
        'headline',
        'message',
        'email',
        'phone',
        'location',
        'github_url',
        'linkedin_url',
    ];
}
