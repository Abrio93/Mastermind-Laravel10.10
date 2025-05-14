@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="text-center">
    <h1 class="my-4">Bienvenido, ¿Qué quieres hacer?</h1>

    <a href="{{ route('juego') }}" class="btn btn-outline-dark mt-5 me-5">Jugar a Mastermind</a>
    <a href="{{ route('reglas') }}" class="btn btn-outline-dark mt-5 ms-5">Leer las reglas</a>
</div>
@endsection