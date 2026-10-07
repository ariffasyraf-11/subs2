<?php

namespace AppModels;

use IlluminateDatabaseEloquentFactoriesHasFactory;
use IlluminateDatabaseEloquentModel;
use IlluminateDatabaseEloquentRelationsBelongsTo;
use IlluminateDatabaseEloquentRelationsHasMany;
use IlluminateDatabaseEloquentBuilder;
use IlluminateSupportCarbon;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'provider', 'name', 'plan_name', 'price',
        'currency', 'billing_cycle', 'start_date', 'next_renewal_date',
        'end_date', 'status', 'auto_renew', 'payment_method', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'start_date' => 'date',
            'next_renewal_date' => 'date',
            'end_date' => 'date',
            'auto_renew' => 'boolean',
        ];
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function category(): BelongsTo { return $this->belongsTo(SubscriptionCategory::class, 'category_id'); }
    public function reminderRules(): HasMany { return $this->hasMany(SubscriptionReminderRule::class); }
    public function payments(): HasMany { return $this->hasMany(SubscriptionPayment::class); }
    public function histories(): HasMany { return $this->hasMany(SubscriptionHistory::class); }
    public function notifications(): HasMany { return $this->hasMany(SubscriptionNotification::class); }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function monthlyCost(): float
    {
        $price = (float) $this->price;

        return match ($this->billing_cycle) {
            'weekly' => $price * 52 / 12,
            'monthly' => $price,
            'quarterly' => $price / 3,
            'half_yearly' => $price / 6,
            'yearly' => $price / 12,
            default => 0,
        };
    }

    public function annualCost(): float
    {
        return $this->monthlyCost() * 12;
    }

    public function daysUntilRenewal(): ?int
    {
        if (! $this->next_renewal_date) {
            return null;
        }

        return Carbon::today()->diffInDays($this->next_renewal_date, false);
    }
}