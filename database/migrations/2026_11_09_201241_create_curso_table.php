<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curso', function (Blueprint $table) {
            $table->integer('Id_Curso')->primary();

            $table->integer('Año')->nullable();

            $table->integer('Id_grado')->nullable();

            $table->integer('Id_docente')->nullable();

            $table->foreign('Id_grado')
                ->references('Id_Grado')
                ->on('grado');

            $table->foreign('Id_docente')
                ->references('Id_Docente')
                ->on('docente');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curso');
    }
};