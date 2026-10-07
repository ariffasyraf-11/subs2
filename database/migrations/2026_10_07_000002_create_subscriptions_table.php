<?php

use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('subscription_categories')->nullOnDelete();
            $table->string('provider');
            $table->string('name');
            $table->string('plan_name')->nullable();
            $table->decimal('price', 12, 2);
            $table->char('currency', 3)->default('MYR');
            $table->string('billing_cycle');
            $table->date('start_date');
            $table->date('next_renewal_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->default('active');
            $table->boolean('auto_renew')->default(true);
            $table->string('payment_method')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['user_id', 'next_renewal_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};