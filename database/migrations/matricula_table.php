<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matricula', function (Blueprint $table) {
            $table->increments('Id_Matricula');

            $table->date('Fecha_Matricula')->nullable();

            $table->unsignedInteger('Id_estudiante')->nullable();

            $table->foreign('Id_estudiante')
                ->references('Id_Estudiante')
                ->on('estudiante');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matricula');
    }
};