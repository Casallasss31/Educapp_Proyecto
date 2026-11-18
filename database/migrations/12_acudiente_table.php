<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acudiente', function (Blueprint $table) {
            $table->id('id_acudiente');

            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuarios');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acudiente');
    }
};