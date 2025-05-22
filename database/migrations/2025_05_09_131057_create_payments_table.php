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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2); // مبلغ پرداخت
            $table->string('transaction_id')->unique(); // شناسه تراکنش
            $table->string('reference_id')->nullable(); // شناسه مرجع
            $table->timestamp('paid_at')->nullable(); // تاریخ پرداخت
            $table->timestamp('failed_at')->nullable(); // تاریخ ناموفق بودن پرداخت
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
