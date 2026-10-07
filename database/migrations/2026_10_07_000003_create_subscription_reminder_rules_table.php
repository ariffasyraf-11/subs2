<?php

use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_reminder_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
            $table->string('event_type');
            $table->unsignedSmallInteger('days_before');
            $table->boolean('enabled')->default(true);
            $table->timestamps();

            $table->unique(['subscription_id', 'event_type', 'days_before']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_reminder_rules');
    }
};