<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
        'alt_text',
        'sort_order',
        'is_primary',
        'is_external',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_primary' => 'boolean',
        'is_external' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute()
    {
        if ($this->is_external) {
            return $this->image;
        }
        return Storage::url($this->image);
    }
}
