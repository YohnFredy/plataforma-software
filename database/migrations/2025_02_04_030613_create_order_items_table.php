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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained()->cascadeOnUpdate();
            $table->string('name'); // Puede ser redundante si 'product' tiene nombre
            $table->integer('quantity')->unsigned()->default(1); // Asegurar que la cantidad no sea negativa
            $table->decimal('price', 10, 2); // Precio unitario del producto
            $table->decimal('discount', 10, 2)->default(0); // Descuento aplicado al ítem (opcional)
            $table->decimal('tax', 10, 2)->default(0); // Impuestos aplicados al ítem (opcional)
            $table->decimal('subtotal', 10, 2); // Subtotal por producto: cantidad * precio
            $table->decimal('pts', 10, 2)->default(0); // Puntos obtenidos por el ítem
            $table->timestamps();

            // Índices para mejorar el rendimiento de las consultas
            $table->index('order_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
