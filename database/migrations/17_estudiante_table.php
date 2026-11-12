<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiante', function (Blueprint $table) {
            $table->id('id_estudiante');

            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->unsignedBigInteger('id_acudiente')->nullable();
            $table->unsignedBigInteger('id_curso')->nullable();

            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuarios');

            $table->foreign('id_acudiente')
                  ->references('id_acudiente')
                  ->on('acudiente');

            $table->foreign('id_curso')
                  ->references('id_curso')
                  ->on('curso');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiante');
    }
};