<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    
    protected $table = 'actores'; //esto lo pongo porque lo puse en español y laravel usa ingles
    protected $fillable = [ //aqui van los campos que cambio o recibo
        'nombre',
    ];
    public function peliculas() //funcion para establecer la relacion
    {
        //pongo peliculas_actores porque hice mal la tabla relacion tendria que ser actor_pelicula o pelicula_actor
        return $this->belongsToMany(Pelicula::class, 'peliculas_actores', 'actores_id', 'peliculas_id');
    }
}
