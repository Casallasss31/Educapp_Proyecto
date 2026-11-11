<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boletin', function (Blueprint $table) {
            $table->increments('Id_Boletin');

            $table->date('Fecha_publicacion')->nullable();

            $table->enum('Periodo', ['1', '2', '3'])->nullable();

            $table->string('Observacion', 150)->nullable();

            $table->unsignedInteger('Id_materia')->nullable();

            $table->unsignedInteger('Id_estudiante')->nullable();

            $table->foreign('Id_materia')
                ->references('Id_Materia')
                ->on('materia');

            $table->foreign('Id_estudiante')
                ->references('Id_Estudiante')
                ->on('estudiante');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boletin');
    }
};