<?php

namespace DatabaseSeeders;

use AppModelsUser;
use IlluminateDatabaseSeeder;
use IlluminateSupportFacadesHash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );

        $this->call(SubscriptionCategorySeeder::class);
    }
}