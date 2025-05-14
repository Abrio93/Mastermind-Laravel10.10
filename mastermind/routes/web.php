<?php

use App\Http\Controllers\JugadaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartidaController;

//? VISTAS

// Vista inicio.blade.php
Route::get('/', function () {
    return view('inicio');
})->name("inicio");

// Vista juego.blade.php
Route::get('/juego', function () {
    return view('juego');
})->name("juego");

// Vista reglas.blade.php
Route::get('/reglas', function () {
    return view('reglas');
})->name("reglas");


//? CONTROLADORES

//*Controlador Partidas
// para crear una partida desde juego
Route::post('/empezar-partida', [PartidaController::class, 'createPartida'])->name('crearpartida');

// para jugar a la partida (por get desde lista-partidas)
Route::get('/partida/{id}', [PartidaController::class, 'showPartida'])->name('partida');

// para jugar a la partida (por post desde partida.blade.php, cuando eliges los colores y envías el formulario)
Route::post('/partida', [PartidaController::class, 'compararColores'])->name('compararcolores');

// para ver el listado de partidas (por get)
Route::get('/lista-partidas', [PartidaController::class, 'showPartidas'])->name('listapartidas');


//* Controlador Jugadas
// para ver las jugadas de una partida (por get desde lista-partidas)
Route::get('/partida/{id}/jugadas', [JugadaController::class, 'showJugadas'])->name('jugadasdepartida');



