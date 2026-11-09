<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materia', function (Blueprint $table) {
            $table->increments('Id_Materia');

            $table->string('Nombre_Materia', 150)->nullable();

            $table->unsignedInteger('Id_area')->nullable();

            $table->unsignedInteger('Id_nota')->nullable();

            $table->foreign('Id_area')
                ->references('Id_Area')
                ->on('area');

            $table->foreign('Id_nota')
                ->references('Id_Nota')
                ->on('nota');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materia');
    }
};