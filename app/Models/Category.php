<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status'
    ];

    /**
     * Get products under this category
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Scope for active categories only
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}