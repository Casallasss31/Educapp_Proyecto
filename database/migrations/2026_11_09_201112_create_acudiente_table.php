<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acudiente', function (Blueprint $table) {
            $table->integer('Id_Acudiente')->primary();

            $table->integer('Numero_Telefono')->nullable();

            $table->string('Correo', 150)->nullable();

            $table->integer('Id_usuario')->nullable();

            $table->foreign('Id_usuario')
                ->references('Id_usuario')
                ->on('usuarios');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acudiente');
    }
};