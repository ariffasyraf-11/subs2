<?php

namespace AppModels;

use IlluminateDatabaseEloquentFactoriesHasFactory;
use IlluminateDatabaseEloquentModel;
use IlluminateDatabaseEloquentRelationsBelongsTo;

class SubscriptionNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'subscription_id', 'reminder_rule_id', 'event_type',
        'scheduled_for', 'generated_at', 'read_at', 'status', 'message',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_for' => 'date',
            'generated_at' => 'datetime',
            'read_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function subscription(): BelongsTo { return $this->belongsTo(Subscription::class); }
    public function reminderRule(): BelongsTo { return $this->belongsTo(SubscriptionReminderRule::class); }
}