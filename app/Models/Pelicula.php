<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $fillable = [
        'titulo',
        'sinopsi',
        'data_estrena',
        'durada',
        'clasificacion',
    ];
    public function actores()
    {
        // Aquí indicamos el nombre de la tabla intermedia de forma explícita
        return $this->belongsToMany(Actor::class, 'peliculas_actores', 'peliculas_id', 'actores_id');
    }
    public function Category()
    {
        // Aquí indicamos el nombre de la tabla intermedia de forma explícita
        return $this->belongsToMany(Category::class, 'category_peliculas', 'peliculas_id', 'category_id');
    }
}
