<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Pelicula::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'sinopsi' => 'nullable|string',
            'data_estrena' => 'date',
            'durada' => 'integer',
            'clasificacion' => 'integer',
        ]);
        $pelicula = Pelicula::create($validated);
        return response()->json($pelicula, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelicula = Pelicula::find($id);

        if (!$pelicula) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        return response()->json($pelicula);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelicula = Pelicula::find($id);
        if (!$pelicula) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'sinopsi' => 'nullable|string',
            'data_estrena' => 'date',
            'durada' => 'integer',
            'clasificacion' => 'integer',
        ]);
        $pelicula->update($validated);
        return response()->json($pelicula);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelicula = Pelicula::find($id);
        if (!$pelicula) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        $pelicula->delete();
        return response()->json(['message' => 'Movie deleted']);
    }
    /*
    cerca combinada
    */
    public function cercaCombinada(Request $request)
    {
        // Validar parámetros de la solicitud
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'actor_id' => 'required|integer|exists:actores,id',
        ]);

        // Recuperar valores de entrada
        $categoryId = $request->input('category_id');
        $actorId = $request->input('actor_id');

        // Consultar películas que cumplan ambos criterios
        $peliculas = Pelicula::whereHas('category', function ($query) use ($categoryId) {
            $query->where('categories.id', $categoryId); // Usar la relación con categorías
        })
            ->whereHas('actores', function ($query) use ($actorId) {
                $query->where('actores.id', $actorId); // Usar la relación con actores
            })
            ->get();
        // Verificar si no se encontraron resultados
        if ($peliculas->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron peliculas que cumplan con los criterios proporcionados'
            ], 404);
        }
        // Retornar las películas encontradas como respuesta JSON
        return response()->json($peliculas, 200);
    }
    public function detallePelicula($id)
    {
        $pelicula = Pelicula::with(['actores', 'category'])->find($id);
        if (!$pelicula) {
            return response()->json(['message' => 'Pelicula no trobada'], 404);
        };
        return response()->json($pelicula);
    }
}
