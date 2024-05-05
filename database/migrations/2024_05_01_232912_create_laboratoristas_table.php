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
        Schema::create('laboratoristas', function (Blueprint $table) {
            $table->bigincrements('laboratorista_id');
            $table->unsignedBigInteger('laboratorista_user_id');
            $table->string('laboratorista_num_emp')->unique();;
            $table->timestamps();

            //CONSTRAINTS
            $table->foreign('laboratorista_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratoristas');
    }
};
