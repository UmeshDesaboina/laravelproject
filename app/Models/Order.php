<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'address_id',
        'coupon_id',
        'status',
        'payment_status',
        'payment_method',
        'payment_id',
        'subtotal',
        'discount',
        'shipping_cost',
        'tax',
        'total',
        'currency',
        'notes',
        'courier_name',
        'tracking_id',
        'cancellation_reason',
        'paid_at',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    protected $appends = ['items_count'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = static::generateOrderNumber();
            }
        });
    }

    public static function generateOrderNumber(): string
    {
        return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 6));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function returnRequests()
    {
        return $this->hasMany(ReturnRequest::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class)->orderByDesc('created_at');
    }

    public function addStatusLog($status, $comment = null)
    {
        $this->statusLogs()->create([
            'status' => $status,
            'comment' => $comment,
            'user_id' => auth()->id()
        ]);
    }

    public function itemsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->items->sum('quantity')
        );
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'confirmed', 'processing']);
    }

    public function canRequestReturn(): bool
    {
        return $this->status === 'delivered' && !$this->returnRequests()->whereIn('status', ['pending', 'approved'])->exists();
    }

    public function markAsPaid(): void
    {
        $this->update([
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
