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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('shift_id')->constrained('shifts')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->decimal('subtotal', 15, 2);
            $table->decimal('discount', 15, 2)->default(0.00);
            $table->decimal('tax', 15, 2)->default(0.00);
            $table->decimal('grand_total', 15, 2);
            $table->enum('payment_method', ['cash', 'qris']);
            $table->decimal('amount_paid', 15, 2);
            $table->decimal('change_due', 15, 2)->default(0.00);
            $table->boolean('is_synced')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
