<?php

namespace Database\Factories;

use App\Models\Partida;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartidaFactory extends Factory
{
    protected $model = Partida::class;

    public function definition()
    {

        //? definimos los nombres para que se elija e inserte aleatoriamente en cada fila de la BD
        $nombres = [
            'Antonio', 'Manuel', 'José', 'Francisco', 'David', 
            'Juan', 'Javier', 'Daniel', 'José Antonio', 'Francisco Javier', 
            'José Luis', 'Carlos', 'Alejandro', 'Jesús', 'José Manuel', 
            'Miguel', 'Miguel Ángel', 'Pablo', 'Rafael', 'Sergio', 
            'Ángel', 'Pedro', 'Fernando', 'Jorge', 'José María', 
            'Luis', 'Alberto', 'Álvaro', 'Adrián', 'Juan Carlos'
        ];

        //? definimos los colores que puede tener el campo codigo_colores
        $colores = ['ff0000', 'f94dda', '43db55', 'ffe138', 'a8a8a8', 'ef9e34', '3247ff'];

        return [
            'nombre' => $this->faker->randomElement($nombres),
            'fecha_hora_creacion' => $this->faker->dateTime,
            'codigo_colores' => implode(',', $this->faker->randomElements($colores, 5)),
            'estado' => $this->faker->randomElement(['En juego', 'Finalizada con victoria', 'Finalizada con derrota']),
            'rondas' => $this->faker->numberBetween(1, 10),
        ];
    }
}
