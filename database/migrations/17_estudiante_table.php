<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiante', function (Blueprint $table) {
            $table->increments('id_estudiante'); 

            $table->unsignedInteger('Id_usuario')->nullable();
            $table->unsignedInteger('id_acudiente')->nullable();
            $table->unsignedInteger('Id_curso')->nullable();

            $table->foreign('Id_usuario')
                  ->references('Id_usuario')
                  ->on('usuarios');

            $table->foreign('id_acudiente')
                  ->references('id_acudiente') 
                  ->on('acudiente');

            $table->foreign('Id_curso')
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