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
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2); // 10,2 permite precios grandes sin desperdiciar espacio
            $table->decimal('commission_income', 8, 2)->nullable();
            $table->decimal('pts', 8, 2)->nullable();
            $table->tinyInteger('maximum_discount')->default(0); // 0-100% más eficiente
            $table->text('specifications')->nullable();
            $table->text('information')->nullable();
            $table->boolean('is_physical')->default(true);
            $table->integer('stock')->nullable(); // Solo para productos físicos
            $table->boolean('allows_backorder')->default(false); 
            $table->foreignId('category_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('brand_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index('category_id');
            $table->index('brand_id');
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
