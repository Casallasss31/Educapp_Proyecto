<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docente', function (Blueprint $table) {
            $table->integer('Id_Docente')->primary();

            $table->integer('Numero_Telefono')->nullable();

            $table->string('Correo', 150)->nullable();

            $table->integer('Id_usuario')->nullable();

            $table->integer('Id_profesion')->nullable();

            $table->foreign('Id_usuario')
                ->references('Id_usuario')
                ->on('usuarios');

            $table->foreign('Id_profesion')
                ->references('Id_Profesion')
                ->on('profesion');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docente');
    }
};