<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acudiente', function (Blueprint $table) {
            $table->increments('id_acudiente');

            $table->unsignedInteger('Id_usuario')->nullable(); 
            
            $table->foreign('Id_usuario')
                  ->references('Id_usuario')
                  ->on('usuarios');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acudiente');
    }
};