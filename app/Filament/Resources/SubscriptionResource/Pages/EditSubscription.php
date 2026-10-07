<?php

namespace AppFilamentResourcesSubscriptionResourcePages;

use AppFilamentResourcesSubscriptionResource;
use FilamentResourcesPagesEditRecord;

class EditSubscription extends EditRecord
{
    protected static string $resource = SubscriptionResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}