<?php

namespace Database\Factories;

use App\Models\Jugada;
use App\Models\Partida;
use Illuminate\Database\Eloquent\Factories\Factory;

class JugadaFactory extends Factory
{
    protected $model = Jugada::class;

    public function definition()
    {

        //? definimos los colores que puede tener el campo codigo_colores y el campo pistas
        $colores =['ff0000', 'f94dda', '43db55', 'ffe138', 'a8a8a8', 'ef9e34', '3247ff'];
        $pistas =['000000', 'ffffff', 'a8a8a8'];

        return [
            'partida_id' => null, //? Se asignará en el seeder (si se intentaba asignar aquí creaba más registros de la cuenta)
            'fecha_hora_recepcion' => $this->faker->dateTime,
            'codigo_colores' => implode(',', $this->faker->randomElements($colores, 5)),
            'pistas' => implode(',', array_map(fn() => $this->faker->randomElement($pistas), range(1, 5))),
            'resultado_evaluacion' => $this->faker->randomElement(['Ganada', 'Seguir jugando', 'Perdida']),
        ];
    }
}