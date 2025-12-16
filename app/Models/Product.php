<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock',
        'sku',
        'image',
        'category_id',
        'status',
        'is_featured',
        'views',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'views' => 'integer',
        'stock' => 'integer',
    ];

    /**
     * Relasi ke Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope untuk produk populer
     */
    public function scopePopular($query)
    {
        return $query->where('is_featured', true)
                     ->orWhere('views', '>', 100)
                     ->orderBy('views', 'desc');
    }

    /**
     * Scope untuk produk aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                     ->where('stock', '>', 0);
    }

    /**
     * Get harga akhir (jika ada diskon, return diskon, jika tidak return harga normal)
     */
    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    /**
     * Check apakah produk sedang diskon
     */
    public function getIsDiscountedAttribute()
    {
        return !is_null($this->discount_price) && $this->discount_price < $this->price;
    }

    /**
     * Get persentase diskon
     */
    public function getDiscountPercentageAttribute()
    {
        if (!$this->is_discounted) {
            return 0;
        }

        return round((($this->price - $this->discount_price) / $this->price) * 100);
    }

    /**
     * Get full image URL
     * Accessor untuk handle berbagai format path gambar
     */
    public function getImageUrlAttribute()
    {
        // Jika image kosong, return placeholder
        if (!$this->image) {
            return asset('images/no-image.png');
        }

        // Jika sudah full URL (http/https)
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // Jika sudah ada path lengkap uploads/products/
        if (str_contains($this->image, 'uploads/products/')) {
            return asset($this->image);
        }

        // Jika cuma filename saja (hasil UPDATE REPLACE tadi)
        return asset('uploads/products/' . $this->image);
    }
}