@extends('layouts.app')

@section('title', 'Reglas')

@section('content')
<div class="text-justify my-4">
    <h1>Reglas de Mastermind</h1>
    <p></p>
    <p>Mastermind es un juego de habilidad y lógica que consiste en descubrir una secuencia de colores oculta.</p>

    <p>
        <b>CÓMO SE JUEGA</b> <br>
        En esta versión de Mastermind creamos el juego introduciendo un nombre (opcional) y unas rondas (mínimo 1 máximo
        10). Una vez estamos en partida la app ha elegido un código de colores secreto que debemos de adivinar,
        escogemos un color para cada posición (hay 5 posiciones y 7 colores a elegir) y le damos a comprobar colores.
        <br><br> Si acertamos los colores en las posiciones correctas antes de que acaben las rondas habremos ganado la
        partida, si por el contrario se acaban las rondas y no hemos acertado el código de colores habremos perdido la
        partida.
    </p>

    <p>
        <b>PISTAS</b> <br>
        En el juego hay una serie de pistas, cuando comprobamos si la secuencia de colores elegidos es correcta aparecen
        3 colores según sea el caso:
        <br><br>
        <b>Negro:</b> El color elegido en esa posición se encuentra en el código secreto que debemos adivinar además de
        estar en la posición correcta.<br>
        <b>Blanco:</b> El color elegido en esa posición se encuentra en el código secreto que debemos adivinar.<br>
        <b>Gris:</b> El color elegido en esa posición no se encuentra en el código secreto que debemos adivinar.<br><br>

        Ejemplo: <br>

        Supongamos que los colores del código secreto son estos:
        <img src="{{ asset('images/colores.png') }}" alt="">
        <br>
        Y elegimos estos colores:
        <img src="{{ asset('images/ejemplo_colores.png') }}" alt="">
        <br><br>
        De color <b>negro</b> la primera posición y la quinta ya que se encuentra en el código secreto y además están en
        la posición exacta. <br>
        De color <b>blanco</b> la segunda posición y la cuarta ya que se encuentra en el código secreto pero no están en
        la posición exacta <br>
        De color <b>gris</b> la tercera posición ya que ese color no se encuentra en el código secreto.
        <br>
</div>
@endsection