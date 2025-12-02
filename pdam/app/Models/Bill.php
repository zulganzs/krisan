<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'user_id',
        'billing_month',
        'previous_reading',
        'current_reading',
        'usage_m3',
        'rate_applied',
        'base_cost',
        'admin_fee',
        'total_cost',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'billing_month' => 'date',
        'paid_at' => 'datetime',
    ];

    /**
     * Relationship to User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor for formatted total cost
     */
    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_cost, 0, ',', '.');
    }

    /**
     * Accessor for formatted usage
     */
    public function getFormattedUsageAttribute(): string
    {
        return number_format($this->usage_m3, 2) . ' m³';
    }
}
