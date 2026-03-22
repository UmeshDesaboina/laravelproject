<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReturnRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_number',
        'order_id',
        'order_item_id',
        'user_id',
        'status',
        'reason',
        'reason_description',
        'resolution',
        'refund_amount',
        'processed_at',
        'courier_name',
        'tracking_id',
        'bank_account_number',
        'bank_ifsc',
        'bank_account_name',
        'refunded_at',
        'admin_notes',
    ];

    protected $casts = [
        'refund_amount' => 'decimal:2',
        'processed_at' => 'datetime',
        'refunded_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($return) {
            if (empty($return->request_number)) {
                $return->request_number = 'RET-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 6));
            }
        });
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function canBeCancelled(): bool
    {
        return $this->status === 'pending';
    }

    public function markAsApproved(string $resolution = 'refund', ?float $refundAmount = null, ?string $courierName = null, ?string $trackingId = null): void
    {
        $this->update([
            'status' => 'approved',
            'resolution' => $resolution,
            'refund_amount' => $refundAmount,
            'courier_name' => $courierName,
            'tracking_id' => $trackingId,
            'processed_at' => now(),
        ]);
    }

    public function markAsRefunded(): void
    {
        $this->update([
            'status' => 'refunded',
            'refunded_at' => now(),
        ]);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
