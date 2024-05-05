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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigincrements('pedido_id');
            $table->unsignedBigInteger('pedido_user_id');
            $table->dateTime('pedido_fec_pre', precision: 0);
            $table->dateTime('pedido_fec_ent', precision: 0)->nullable(true);
            $table->string('pedido_estado');
            $table->timestamps();

            //CONSTRAINTS
            $table->foreign('pedido_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
