<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barrio', function (Blueprint $table) {
            $table->increments('Id_Barrio');

            $table->integer('Estrato')->nullable();

            $table->string('Nombre_Barrio', 150)->nullable();

            $table->string('Direccion', 250)->nullable();

            $table->integer('Id_localidad')->nullable();

            $table->foreign('Id_localidad')
                ->references('Id_Localidad')
                ->on('localidad');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barrio');
    }
};