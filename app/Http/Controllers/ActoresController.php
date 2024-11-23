<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Actor::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $actor = Actor::create($validated);
        return response()->json($actor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $actor = Actor::find($id);
        if (!$actor) {
            return response()->json(['message' => 'Actor not found'], 404);
        }
        return response()->json($actor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $actor = Actor::find($id);
        if (!$actor) {
            return response()->json(['message' => 'Actor not found'], 404);
        }
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $actor->update($validated);
        return response()->json($actor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $actor = Actor::find($id);
        if (!$actor) {
            return response()->json(['message' => 'Actor not found'], 404);
        }
        $actor->delete();
        return response()->json(['message' => 'Actor deleted']);
    }
    public function cercar(string $id)
    {
        /*
        CERCADOR AMB SQL ->  películes relacionades amb actor
        p.id pelicula id
        pa peliculas_actores
        $id com parametre -> retorna pelicules
        */
        $actorExists = DB::table('actores')->where('id', $id)->exists();
        if (!$actorExists) {
            return response()->json(['message' => 'Actor not found'], 404);
        }
        $peliculas = DB::select(
            'SELECT p.id, p.titulo, p.data_estrena, p.durada, p.clasificacion
            FROM peliculas p
            INNER JOIN peliculas_actores pa ON p.id = pa.peliculas_id
            WHERE pa.actores_id = ?',
            [$id]
        );
        return response()->json($peliculas, 200);
        /*
        // Buscar el actor por ID
        $actor = Actor::find($id);

        // Si no se encuentra el actor, devolver un error 404
        if (!$actor) {
            return response()->json(['message' => 'Actor no trobat.'], 404);
        }

        // Obtener las películas asociadas al actor
        $peliculas = $actor->peliculas()->get();  // Asegurarse de ejecutar la consulta

        // Devolver las películas en formato JSON
        return response()->json($peliculas, 200);  // El código de respuesta es 200 para éxito
        */
    }
}
