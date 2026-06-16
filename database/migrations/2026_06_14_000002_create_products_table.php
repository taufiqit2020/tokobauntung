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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->string('product_code')->unique(); // Kode Barang
            $table->string('name');
            $table->string('unit')->default('pcs');
            $table->decimal('buy_price', 15, 2)->default(0.00);
            $table->decimal('sell_price', 15, 2)->default(0.00);
            $table->decimal('wholesale_price', 15, 2)->nullable();
            $table->integer('wholesale_min_qty')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(5);
            $table->string('image_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
