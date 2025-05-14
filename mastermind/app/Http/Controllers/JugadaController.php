<?php

namespace App\Http\Controllers;

use App\Models\Jugada;
use Carbon\Carbon;

class JugadaController extends Controller
{

    //? para ver las jugadas de una partida en concreto en la vista jugadasdepartida.blade.php
    public function showJugadas($id)
    {

        //? buscamos las jugadas de una partida
        $jugadas = Jugada::where('partida_id', $id)->get();

        //? Recorremos cada jugada y formateamos la fecha de creación para que se vea más claro
        //? fecha_formateada no es una columna de la BD pero me invento la propiedad para mostrar la fecha      
        foreach ($jugadas as $jugada) {
            $dateTime = Carbon::parse($jugada->fecha_hora_recepcion);
            $jugada->fecha_formateada = $dateTime->format('d-m-Y H:i:s');
        }

        //? retornamos a la vista la variable jugadas        
        return view('jugadasdepartida', compact('jugadas'));
    }
}
