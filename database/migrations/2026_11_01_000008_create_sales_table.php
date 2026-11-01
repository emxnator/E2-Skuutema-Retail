<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sale_id');
            $table->foreignId('branch_id')->constrained('branches', 'branch_id')->restrictOnDelete();
            $table->foreignId('product_id')->constrained('products', 'product_id')->restrictOnDelete();
            $table->unsignedInteger('quantity_sold');
            $table->decimal('total_revenue', 12, 2);
            $table->timestamp('sale_date')->useCurrent()->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
