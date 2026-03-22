<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'description',
        'short_description',
        'sku',
        'price',
        'compare_price',
        'cost_price',
        'quantity',
        'low_stock_threshold',
        'is_active',
        'is_featured',
        'delivery_type',
        'delivery_charge',
        'published_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'delivery_charge' => 'decimal:2',
        'quantity' => 'integer',
        'low_stock_threshold' => 'integer',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected $appends = ['is_on_sale', 'discount_percentage'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function primaryImage(): HasMany
    {
        return $this->hasMany(ProductImage::class)->where('is_primary', true);
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class)->where('is_active', true);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function mainImage(): BelongsTo
    {
        return $this->belongsTo(ProductImage::class, 'product_id')
            ->where('is_primary', true)
            ->withDefault();
    }

    public function isOnSale(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->compare_price && $this->compare_price > $this->price
        );
    }

    public function discountPercentage(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->compare_price
                ? round((($this->compare_price - $this->price) / $this->compare_price) * 100)
                : 0
        );
    }

    public function isLowStock(): bool
    {
        return $this->quantity <= $this->low_stock_threshold;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('quantity', '>', 0);
    }
}
