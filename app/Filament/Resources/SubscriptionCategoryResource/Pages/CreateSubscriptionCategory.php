<?php

namespace AppFilamentResourcesSubscriptionCategoryResourcePages;

use AppFilamentResourcesSubscriptionCategoryResource;
use FilamentResourcesPagesCreateRecord;

class CreateSubscriptionCategory extends CreateRecord
{
    protected static string $resource = SubscriptionCategoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}