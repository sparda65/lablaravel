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
        Schema::create('pedido_material', function (Blueprint $table) {
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('pedido_user_id');
            $table->unsignedBigInteger('pedido_material_id');
            $table->timestamps();
            //CONSTRAINTS
            $table->foreign('pedido_id')->references('pedido_id')->on('pedidos');
            $table->foreign('pedido_user_id')->references('id')->on('users');
            $table->foreign('pedido_material_id')->references('material_id')->on('materiales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_material');
    }
};
