<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eps', function (Blueprint $table) {
            $table->increments('Id_EPS');

            $table->string('Nombre_Eps', 150)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eps');
    }
};