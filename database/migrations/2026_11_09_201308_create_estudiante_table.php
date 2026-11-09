<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiante', function (Blueprint $table) {
            $table->integer('Id_Estudiante')->primary();

            $table->integer('Id_usuario')->nullable();

            $table->integer('Id_acudiente')->nullable();

            $table->integer('Id_Curso')->nullable();

            $table->foreign('Id_usuario')
                ->references('Id_usuario')
                ->on('usuarios');

            $table->foreign('Id_acudiente')
                ->references('Id_Acudiente')
                ->on('acudiente');

            $table->foreign('Id_Curso')
                ->references('Id_Curso')
                ->on('curso');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiante');
    }
};