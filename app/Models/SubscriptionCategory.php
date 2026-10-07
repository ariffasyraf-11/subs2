<?php

namespace AppModels;

use IlluminateDatabaseEloquentFactoriesHasFactory;
use IlluminateDatabaseEloquentModel;
use IlluminateDatabaseEloquentRelationsBelongsTo;
use IlluminateDatabaseEloquentRelationsHasMany;

class SubscriptionCategory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'description'];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }

    public function subscriptions(): HasMany { return $this->hasMany(Subscription::class, 'category_id'); }
}