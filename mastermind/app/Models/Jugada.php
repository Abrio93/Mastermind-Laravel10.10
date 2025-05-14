<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugada extends Model
{
    use HasFactory;

    //? Para deshabilitar timestamps automáticos (created_at y updated_at)
    public $timestamps = false;

    //? Esta propiedad define un array de atributos que se pueden asignar en masa. Es una medida de seguridad para evitar la asignación masiva de atributos no deseados.
    protected $fillable = [
        'partida_id',
        'fecha_hora_recepcion',
        'codigo_colores',
        'pistas',
        'resultado_evaluacion'
    ];

    //? para que se convierta automáticamente a un objeto datetime cuando se acceda a él.
    protected $casts = [
        'fecha_hora_recepcion' => 'datetime'
    ];

    //? Relación con la tabla Partidas
    public function partida()
    {
        return $this->belongsTo(Partida::class);
    }
}
