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
        Schema::create('product_buy_items', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignId('product_buy_id')->constrained('product_buys')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity');
            $table->foreignId('product_purchase_id')->constrained('product_purchases')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_buy_items');
    }
};
