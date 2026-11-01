<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_complaints', function (Blueprint $table) {
            $table->id('complaint_id');
            $table->string('customer_name');
            $table->string('customer_contact');
            $table->foreignId('product_id')->constrained('products', 'product_id')->restrictOnDelete();
            $table->foreignId('branch_id')->constrained('branches', 'branch_id')->restrictOnDelete();
            // Nullable: een klacht is pas aan een medewerker gekoppeld zodra deze in behandeling is genomen
            $table->foreignId('handled_by_user_id')->nullable()->constrained('users', 'user_id')->nullOnDelete();
            $table->text('complaint_description');
            $table->string('status')->default('open')->index();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_complaints');
    }
};
