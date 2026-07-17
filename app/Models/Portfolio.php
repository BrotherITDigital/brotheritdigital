<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'short_description', 'description',
        'technologies', 'live_url', 'github_url', 'category',
        'client', 'completed_at', 'is_featured', 'is_active',
        'order', 'thumbnail', 'pdf_file', 'gallery', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'technologies' => 'array',
        'gallery'      => 'array',
        'is_featured'  => 'boolean',
        'is_active'    => 'boolean',
        'completed_at' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function categoryModel()
    {
        return $this->belongsTo(PortfolioCategory::class, 'category', 'slug');
    }
}
