<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profesion', function (Blueprint $table) {
            $table->increments('Id_Profesion');

            $table->string('Nombre_Profesion', 150)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profesion');
    }
};