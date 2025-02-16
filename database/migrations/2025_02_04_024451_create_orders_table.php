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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('public_order_number')->unique();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->string('contact');
            $table->string('phone');
            $table->tinyInteger('status')->default(1)->unsigned();
            $table->enum('envio_type', ['store', 'delivery']); // Cambié a nombres más descriptivos
            $table->float('discount')->default(0);
            $table->float('shipping_cost')->default(0);
            $table->float('total')->default(0)->check('total >= 0'); // Asegurar que el total no sea negativo
            $table->decimal('total_pts', 10, 2)->default(0)->check('total_pts >= 0'); // Asegurar que los puntos no sean negativos
            $table->foreignId('country_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('department_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('city_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('additional_address')->nullable();
            $table->timestamps();

            $table->index('public_order_number');
            $table->index('status'); // Índice para facilitar las consultas por estado
            $table->index('user_id'); // Índice para facilitar las consultas por usuario

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
