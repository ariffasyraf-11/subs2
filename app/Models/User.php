<?php

namespace AppModels;

use IlluminateDatabaseEloquentFactoriesHasFactory;
use IlluminateFoundationAuthUser as Authenticatable;
use IlluminateNotificationsNotifiable;
use IlluminateDatabaseEloquentRelationsHasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected function casts(): array
    {
        return ['email_verified_at' => 'datetime', 'password' => 'hashed'];
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscriptionCategories(): HasMany
    {
        return $this->hasMany(SubscriptionCategory::class);
    }

    public function subscriptionNotifications(): HasMany
    {
        return $this->hasMany(SubscriptionNotification::class);
    }
}