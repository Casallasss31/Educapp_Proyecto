<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horario_academico', function (Blueprint $table) {
            $table->increments('Id_Horario_Academico');

            $table->string('Dias_semana', 100)->nullable();

            $table->time('Hora_inicio')->nullable();

            $table->time('Horario_final')->nullable();

            $table->unsignedInteger('Id_curso')->nullable();

            $table->unsignedInteger('Id_materia')->nullable();

            $table->foreign('Id_curso')
                ->references('Id_Curso')
                ->on('curso');

            $table->foreign('Id_materia')
                ->references('Id_Materia')
                ->on('materia');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horario_academico');
    }
};