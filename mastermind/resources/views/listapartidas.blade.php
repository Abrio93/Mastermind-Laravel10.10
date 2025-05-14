@extends('layouts.app')

@section('title', 'Lista de Partidas')

@section('content')
    <div class="container mb-5">
        <h1 class="my-4">Lista de Partidas</h1>
        {{-- ? Ponemos el id miDataTable para poder utilizar el plugin de data table --}}
        <table class="table table-secondary table-striped text-center" id="miDataTable">
            <thead>
                <tr class="table-dark">
                    <th>Partida Nº</th>
                    <th>Nombre</th>
                    <th>Fecha y Hora</th>
                    <th>Código de Colores</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($partidas as $clave => $partida)
                    <tr>
                        <td>{{ $clave + 1 }}</td>
                        <td>{{ $partida->nombre }}</td>
                        <td>{{ $partida->fecha_formateada }}</td>
                        <td>
                            @if ($partida->estado != 'En juego')
                                @foreach (explode(',', $partida->codigo_colores) as $color)
                                    <span class="colores-tabla" style="background-color: #{{ $color }};"></span>
                                @endforeach
                            @else
                                Termina para saber los colores
                            @endif
                        </td>
                        <td>{{ $partida->estado }}</td>
                        <td>
                            <a href="{{ route('jugadasdepartida', $partida->id) }}" class="btn btn-outline-dark btn-sm">Ver
                                Jugadas</a>
                            @if ($partida->estado == 'En juego')
                                <a href="{{ route('partida', $partida->id) }}" class="btn btn-outline-dark btn-sm">Seguir
                                    jugando</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
