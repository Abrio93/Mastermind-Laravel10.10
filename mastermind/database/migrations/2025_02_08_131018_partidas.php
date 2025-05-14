<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {

        //? check se utiliza para agregar una restricción de verificación a una columna en una tabla de la base de datos. 
        Schema::create('partidas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamp('fecha_hora_creacion');
            $table->string('codigo_colores');
            $table->enum('estado', ['En juego', 'Finalizada con victoria', 'Finalizada con derrota']);
            $table->integer('rondas')->default(1)->check('rondas >= 1 AND rondas <= 10');
        });
    }

    public function down() {
        Schema::dropIfExists('partidas');
    }
};
