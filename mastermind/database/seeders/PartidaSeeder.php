<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partida;
use App\Models\Jugada;

class PartidaSeeder extends Seeder
{
    public function run()
    {

        //? Crea 10 instancias del modelo Partida utilizando su factory y las guarda en la base de datos.
        Partida::factory()->count(10)->create()->each(function ($partida) {

                //? Genera un número aleatorio de jugadas (entre 3 y 10) para esta partida
                $jugadas = Jugada::factory()->count(rand(3, 10))->make();
                
                //? Por cada jugada creada, se asigna el id de la partida a la propiedad 'partida_id',
                //? para establecer la relación entre la jugada y la partida
                $jugadas->each(function ($jugada) use ($partida) {
                    $jugada->partida_id = $partida->id;
                });

                //? Guarda todas las jugadas creadas en la base de datos asociándolas a la partida actual,
                //? utilizando la relación definida en el modelo Partida
                $partida->jugadas()->saveMany($jugadas);

            });
    }
}