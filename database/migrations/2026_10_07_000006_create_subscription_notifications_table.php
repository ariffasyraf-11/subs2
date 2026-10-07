<?php

use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reminder_rule_id')->nullable()->constrained('subscription_reminder_rules')->nullOnDelete();
            $table->string('event_type');
            $table->date('scheduled_for');
            $table->timestamp('generated_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->string('status')->default('generated');
            $table->text('message');
            $table->timestamps();

            $table->unique(
                ['subscription_id', 'reminder_rule_id', 'event_type', 'scheduled_for'],
                'subscription_notifications_unique_event'
            );
            $table->index(['user_id', 'read_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_notifications');
    }
};