@extends('layouts.app')

@section('title', 'Juego')

@section('content')
<div class="container">
    <div class="text-center">

        <div class="row justify-content-center">
            <div class="col-md-4">
                <h1 class="my-4">Rellena los datos</h1>
                <form action="{{ route('crearpartida') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label mt-3"><b>Nombre</b></label>
                        <input type="text" class="form-control text-center" placeholder="Opcional" id="nombre" name="nombre">
                        <label for="rondas" class="form-label mt-3"><b>Rondas</b></label>
                        <input type="number" class="form-control text-center" placeholder="Máximo 10" id="rondas" name="rondas">
                    </div>
                    <button type="submit" class="btn btn-outline-dark mt-3">Crear partida</button>
                </form>
                @if ($errors->any())
                <div class="alert alert-danger mt-5">
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection