<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('branch_id')->constrained('branches', 'branch_id')->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users', 'user_id')->restrictOnDelete();
            $table->string('order_status')->default('pending')->index();
            $table->time('cutoff_time')->nullable();
            $table->timestamp('order_date')->useCurrent();
            $table->date('delivery_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
