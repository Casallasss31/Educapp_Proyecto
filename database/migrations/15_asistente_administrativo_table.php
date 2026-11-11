<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistente_administrativo', function (Blueprint $table) {
            $table->increments('Id_Asistente_Administrativo');

            $table->integer('Numero_Telefono')->nullable();

            $table->string('Correo', 150)->nullable();

            $table->unsignedInteger('Id_usuario')->nullable();

            $table->unsignedInteger('Id_profesion')->nullable();

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
        Schema::dropIfExists('asistente_administrativo');
    }
};