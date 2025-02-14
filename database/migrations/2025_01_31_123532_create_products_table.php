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
            $table->string('name');
            $table->text('slug')->unique();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('regular_price');
            $table->string('sale_price');
            $table->string('sku');
            $table->enum('stock_status',['instock','outofstock']);
            $table->boolean('featured')->default(false);
            $table->unsignedBigInteger('quantity')->default(10);
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->softDeletes();
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
