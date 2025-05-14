<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use App\Models\Jugada;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PartidaController extends Controller
{

    //? muestra la vista de la partida por get | vista partida.blade.php
    public function showPartida($id)
    {
        //? buscamos la partida
        $partida = Partida::findOrFail($id);

        //? si la partida no está en estado "En juego" volvemos a donde estábamos (para evitar entrar en una partida finalizada)
        if ($partida->estado != "En juego") {
            return back();
        }

        //? convertimos los colores en un array para recorrerlos en la vista si queremos (lo he dejado comentado)
        //? colores no es una columna de la BD pero me invento la propiedad para mostrar los colores si queremos
        $partida->colores = explode(',', $partida->codigo_colores);

        //? buscamos las jugadas de la partida | la buscamos aquí y cuando enviamos a comparar los colores ¿Por qué?
        //? Por que por aquí es cuando llega por get y en compararColores es por post, así podemos entrar por la vista de
        //? lista de partidas (get) o en la función compararColores (post) y realiza la búsqueda para que no haya fallos
        $jugadas = Jugada::where('partida_id', $id)->orderBy('fecha_hora_recepcion', 'desc')->get();

        //? Recorremos cada jugada y formateamos la fecha de creación para que se vea más claro
        //? fecha_formateada no es una columna de la BD pero me invento la propiedad para mostrar la fecha
        foreach ($jugadas as $jugada) {
            $dateTime = Carbon::parse($jugada->fecha_hora_recepcion);
            $jugada->fecha_formateada = $dateTime->format('d-m-Y H:i:s');
        }

        //? retornamos a la vista las variables partida y jugadas
        return view('partida', compact('partida', 'jugadas'));
    }

    //? Para ver la lista de partidas por get | vista listapartidas.blade.php
    public function showPartidas()
    {
        //? sacamos todas las partidas
        $partidas = Partida::all();

        //? Recorremos cada partida y formateamos la fecha de creación para que se vea más claro
        //? fecha_formateada no es una columna de la BD pero me invento la propiedad para mostrar la fecha      
        foreach ($partidas as $partida) {
            $dateTime = Carbon::parse($partida->fecha_hora_creacion);
            $partida->fecha_formateada = $dateTime->format('d-m-Y H:i:s');
        }

        //? retornamos a la vista la variable partida
        return view('listapartidas', compact('partidas'));
    }

    //? enviamos el formulario desde juego.blade.php por post, creamos la partida y vamos a partida.blade.php
    public function createPartida(Request $request)
    {

        //? validamos el formulario
        $request->validate([
            'nombre' => 'nullable|string|max:20',
            'rondas' => 'nullable|integer|min:1|max:10'
        ], [
            'nombre.max' => 'El nombre no puede ser mayor a 20.',
            'rondas.integer' => 'El campo rondas debe ser un número entero.',
            'rondas.min' => 'El número de rondas debe ser al menos 1.',
            'rondas.max' => 'El número de rondas no puede ser mayor a 10.'
        ]);

        //? Asignamos "Invitado" si el nombre está vacío
        $nombre = $request->input('nombre') ?: 'Invitado';
        //? Asignamos 10 si rondas está vacío
        $rondas = $request->input('rondas') ?: 10;

        //? Los colores son ['rojo', 'rosa', 'verde', 'amarillo', 'gris', 'naranja', 'azul'];
        $colores = ['ff0000', 'f94dda', '43db55', 'ffe138', 'a8a8a8', 'ef9e34', '3247ff'];
        //? mezcla los elementos del array $colores de manera aleatoria
        shuffle($colores);
        
        //? Toma una porción del array $colores, en este caso, selecciona los primeros 5 elementos del array mezclado y los asigna a la variable $colores_seleccionados
        $colores_seleccionados = array_slice($colores, 0, 5);

        //? creamos la partida
        $partida = Partida::create([
            'nombre' => $nombre,
            'fecha_hora_creacion' => now(),
            'codigo_colores' => implode(',', $colores_seleccionados),
            'estado' => 'En juego',
            'rondas' => $rondas
        ]);

        //? convertimos los colores en un array para recorrerlos en la vista si queremos (lo he dejado comentado)
        //? colores no es una columna de la BD pero me invento la propiedad para mostrar los colores si queremos
        $partida->colores = explode(',', $partida->codigo_colores);

        //? retornamos a la vista la variable partida
        return view('partida', compact('partida'));
    }


    //? vista partida.blade.php
    public function compararColores(Request $request)
    {

        //? buscamos la partida que estamos jugando
        $partida = Partida::findOrFail($request->input('partida_id'));

        //? convertimos la cadena en un array
        $colores_seleccionados = explode(',', $partida->codigo_colores);
        //? Quitamos el símbolo '#' para que el formato sea similar
        $colores_usuario = array_map(function ($color) {
            return ltrim($color, '#');
        }, $request->input('colores'));

        //? Creamos un array para las pistas y le añadimos en cada posición el color de cada pista
        $pistas = [];
        for ($i = 0; $i < count($colores_usuario); $i++) {
            if ($colores_usuario[$i] === $colores_seleccionados[$i]) {
                //? Coincidencia exacta: color negro
                $pistas[] = '000000';
            } elseif (in_array($colores_usuario[$i], $colores_seleccionados)) {
                //? El color existe en los seleccionados, pero en otra posición: color blanco
                $pistas[] = 'ffffff';
            } else {
                //? El color no existe en los seleccionados: color gris
                $pistas[] = 'a8a8a8';
            }
        }

        //? restamos una ronda a la partida
        $partida->rondas -= 1;

        //? depende lo que haya pasado (tener más rondas, acertar todos los colores o perder) asignamos un estado
        $resultado = 'Seguir jugando';
        if ($colores_usuario === $colores_seleccionados) {
            $resultado = 'Ganada';
            $partida->estado = 'Finalizada con victoria';
        } elseif ($partida->rondas <= 0) {
            $partida->estado = 'Finalizada con derrota';
            $resultado = 'Perdida';
        }

        //? guardamos los cambios de la partida en la tabla partidas
        $partida->save();

        //? creamos una jugada relacionada con la partida actual
        Jugada::create([
            'partida_id' => $partida->id,
            'fecha_hora_recepcion' => now(),
            'codigo_colores' => implode(',', $colores_usuario),
            'pistas' => implode(',', $pistas),  // Convertimos el array de pistas en una cadena separada por comas
            'resultado_evaluacion' => $resultado
        ]);

        //? convertimos los colores en un array para recorrerlos en la vista si queremos (lo he dejado comentado)
        //? colores no es una columna de la BD pero me invento la propiedad para mostrar los colores si queremos
        $partida->colores = explode(',', $partida->codigo_colores);

        //? buscamos las jugadas de la partida | la buscamos aquí y cuando seguirmos jugando desde la lista de partidas ¿Por qué?
        //? Por que por aquí es cuando llega por post y en lista de partidas es por get, así podemos entrar por la vista de
        //? lista de partidas (get) o en la función compararColores (post) y realiza la búsqueda para que no haya fallos
        $jugadas = Jugada::where('partida_id', $partida->id)->orderBy('fecha_hora_recepcion', 'desc')->get();

        //? Recorremos cada jugada y formateamos la fecha de creación para que se vea más claro
        //? fecha_formateada no es una columna de la BD pero me invento la propiedad para mostrar la fecha
        foreach ($jugadas as $jugada) {
            $dateTime = Carbon::parse($jugada->fecha_hora_recepcion);
            $jugada->fecha_formateada = $dateTime->format('d-m-Y H:i:s');
        }

        //? retornamos a la vista las variables partida y jugadas
        return view('partida', compact('partida', 'jugadas'));
    }
}
