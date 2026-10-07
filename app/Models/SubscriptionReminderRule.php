<?php

namespace AppModels;

use IlluminateDatabaseEloquentFactoriesHasFactory;
use IlluminateDatabaseEloquentModel;
use IlluminateDatabaseEloquentRelationsBelongsTo;

class SubscriptionReminderRule extends Model
{
    use HasFactory;

    protected $fillable = ['subscription_id', 'event_type', 'days_before', 'enabled'];

    protected function casts(): array
    {
        return ['enabled' => 'boolean'];
    }

    public function subscription(): BelongsTo { return $this->belongsTo(Subscription::class); }
}