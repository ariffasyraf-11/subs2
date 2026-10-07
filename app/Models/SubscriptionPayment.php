<?php

namespace AppModels;

use IlluminateDatabaseEloquentFactoriesHasFactory;
use IlluminateDatabaseEloquentModel;
use IlluminateDatabaseEloquentRelationsBelongsTo;

class SubscriptionPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id', 'amount', 'currency', 'paid_at',
        'payment_method', 'reference', 'notes',
    ];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2', 'paid_at' => 'date'];
    }

    public function subscription(): BelongsTo { return $this->belongsTo(Subscription::class); }
}