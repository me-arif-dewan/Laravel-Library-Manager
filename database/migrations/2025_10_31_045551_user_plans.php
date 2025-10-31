<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('plan_id')->constrained()->cascadeOnDelete();
            $table->string('plan_type');
            $table->timestamp('started_at');
            $table->timestamp('expires_at')->nullable();
            $table->string('stripe_subscription_id')->nullable();
            $table->string('status')->default('active');
            $table->integer('price_paid')->nullable();
            $table->string('currency', 3)->default('usd');
            $table->timestamps();

            $table->index(['expires_at', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_plans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['plan_id']);
        });
        Schema::dropIfExists('user_plans');
    }
};
