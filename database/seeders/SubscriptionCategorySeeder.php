<?php

namespace DatabaseSeeders;

use AppModelsSubscriptionCategory;
use AppModelsUser;
use IlluminateDatabaseSeeder;

class SubscriptionCategorySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->first();

        if (! $user) {
            return;
        }

        foreach (['Software', 'Streaming', 'Hosting', 'Membership', 'Insurance', 'Other'] as $name) {
            SubscriptionCategory::firstOrCreate([
                'user_id' => $user->id,
                'name' => $name,
            ]);
        }
    }
}