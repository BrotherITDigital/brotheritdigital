<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'position', 'bio', 'skills',
        'social_links', 'photo', 'email', 'is_active', 'order',
    ];

    protected $casts = [
        'skills'       => 'array',
        'social_links' => 'array',
        'is_active'    => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
