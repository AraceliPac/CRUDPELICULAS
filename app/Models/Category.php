<?php

namespace App\Models;

use App\Http\Controllers\PeliculasController;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [ //aqui van los campos que cambio o recibo ->atributos son "asignables en masa"
        'nombre',
    ];
    public function peliculas() //funcion para establecer la relacion
    {
        return $this->belongsToMany(Pelicula::class, 'category_peliculas', 'category_id', 'peliculas_id');
    }
} 
