<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('jugadas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partida_id')->constrained('partidas')->onDelete('cascade');
            $table->timestamp('fecha_hora_recepcion');
            $table->string('codigo_colores', 255);
            $table->string('pistas', 255);
            $table->enum('resultado_evaluacion', ['Ganada', 'Seguir jugando', 'Perdida']);
        });
    }

    public function down() {
        Schema::dropIfExists('jugadas');
    }
};
