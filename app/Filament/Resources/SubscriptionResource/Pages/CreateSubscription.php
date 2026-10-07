<?php

namespace AppFilamentResourcesSubscriptionResourcePages;

use AppFilamentResourcesSubscriptionResource;
use FilamentResourcesPagesCreateRecord;

class CreateSubscription extends CreateRecord
{
    protected static string $resource = SubscriptionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}