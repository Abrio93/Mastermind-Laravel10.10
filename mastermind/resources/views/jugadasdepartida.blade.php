@extends('layouts.app')

@section('title', 'Jugadas de la Partida')

@section('content')
<div class="container">
    <h1 class="my-4">Jugadas de la Partida</h1>
    <a href="{{ route('listapartidas') }}" class="btn btn-dark mb-3">Volver a la Lista de Partidas</a>
    <table class="table table-secondary table-striped text-center" id="jugadas-table">
        <thead>
            <tr class="table-dark">
                <th>Movimiento Nº</th>
                <th>Fecha y Hora</th>
                <th>Código de Colores</th>
                <th>Pistas</th>
                <th>Resultado de la Evaluación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jugadas as $clave => $jugada)
                <tr>
                    <td>{{ $clave + 1 }}</td>
                    <td>{{ $jugada->fecha_formateada }}</td>
                    <td>
                        @foreach (explode(',', $jugada->codigo_colores) as $color)
                            <span class="colores-tabla" style="background-color: #{{ $color }};"></span>
                        @endforeach
                    </td>
                    <td>
                        @foreach (explode(',', $jugada->pistas) as $pista)
                            <span class="colores-tabla" style="background-color: #{{ $pista }};"></span>
                        @endforeach
                    </td>
                    <td>{{ $jugada->resultado_evaluacion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection