@extends('layouts.app')

@section('title', 'Partida')

@section('content')
<div class="container">
    <h1>{{ $partida->nombre }}</h1>
    <p class="mt-3"> <b>Estado:</b> {{ $partida->estado }} | <b>Rondas restantes:</b> {{ $partida->rondas }}</p>

    {{-- DEJO ESTO COMENTADO POR SI SE QUIEREN VER LOS COLORES SELECCIONADOS POR LA APP --}}

    {{-- <p>Colores:
        @foreach ($partida->colores as $color)
            <span style="background-color: #{{ $color }}; padding: 5px; margin-right: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
        @endforeach
    </p> --}}

    {{-- @if (session('resultado'))
    <p>Resultado: {{ session('resultado') }}</p>
    @endif --}}

</div>
@if ($partida->estado !== 'Finalizada con victoria' && $partida->estado !== 'Finalizada con derrota')
    <form action="{{ route('compararcolores') }}" method="POST">
        @csrf
        <input type="hidden" name="partida_id" value="{{ $partida->id }}">
        <div class="mb-3 mt-5">
            <label for="colores" class="form-label ms-2">Introduce tus colores</label>
            <div class="d-flex justify-content-center">
                @for ($i = 0; $i < 5; $i++)
                    <input type="color" class="form-control mx-1" name="colores[]" list="colores-predefinidos" required>
                @endfor
            </div>
            <datalist id="colores-predefinidos">
                <option value="#ff0000">Rojo</option>
                <option value="#f94dda">Rosa</option>
                <option value="#43db55">Verde</option>
                <option value="#ffe138">Amarillo</option>
                <option value="#a8a8a8">Gris</option>
                <option value="#ef9e34">Naranja</option>
                <option value="#3247ff">Azul</option>
            </datalist>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <button type="submit" class="btn btn-outline-dark">Comparar colores</button>
        </div>
    </form>
@else
    <div class="text-center mt-5">
        <a href="{{ route('juego') }}" class="btn btn-outline-dark me-1">Jugar otra partida</a>
        <a href="{{ route('listapartidas') }}" class="btn btn-outline-dark mx-2">Ver partidas</a>
        <a href="{{ route('jugadasdepartida', ['id' => $partida->id]) }}" class="btn btn-outline-dark ms-1">Ver jugadas</a>
    </div>
@endif
<div class="d-flex justify-content-center">
    <h2 class="mt-5 mb-3">Jugadas</h2>
</div>
<table class="table table-secondary table-striped text-center" id="partidas-table">
    <thead>
        <tr class="table-dark">
            <th>Jugada Nº</th>
            <th>Fecha</th>
            <th>Colores</th>
            <th>Pistas</th>
            <th>Resultado</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($jugadas) && $jugadas->isNotEmpty())
            @foreach ($jugadas as $clave => $jugada)
                <tr>
                    <td>{{ count($jugadas) - $clave }}</td>
                    <td>{{ $jugada->fecha_formateada }}</td>
                    <td>
                        @foreach (explode(',', $jugada->codigo_colores) as $color)
                            <span class="colores-tabla mt-1" style="background-color: #{{ $color }};"></span>
                        @endforeach
                    </td>
                    <td>
                        @foreach (explode(',', $jugada->pistas) as $pista)
                            <span class="colores-tabla" style="background-color: #{{ $pista }};"></span>
                        @endforeach
                    </td>
                    {{-- <td>{{ $jugada->aciertos }}</td> --}}
                    <td>{{ $jugada->resultado_evaluacion }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <th colspan="5">No hay jugadas registradas aún.</th>
            </tr>
        @endif
    </tbody>
</table>

{{-- Alertas para cuando ganamos o perdemos la partida --}}
@if ($partida->estado == "Finalizada con victoria")
    <script>
        Swal.fire({
            title: '¡Victoria!',
            text: 'Enhorabuena has ganado la partida',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            customClass: {
                confirmButton: 'btn btn-dark'
            },
            buttonsStyling: false
        })
    </script>
@elseif ($partida->estado == "Finalizada con derrota")
    <script>
        Swal.fire({
            title: '¡Has perdido!',
            text: 'Lo sentimos has perdido la partida, intentalo de nuevo',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            customClass: {
                confirmButton: 'btn btn-dark'
            },
            buttonsStyling: false
        })
    </script>
@endif
@endsection