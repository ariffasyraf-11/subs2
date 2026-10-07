<?php

namespace AppFilamentResourcesSubscriptionCategoryResourcePages;

use AppFilamentResourcesSubscriptionCategoryResource;
use FilamentResourcesPagesEditRecord;

class EditSubscriptionCategory extends EditRecord
{
    protected static string $resource = SubscriptionCategoryResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}