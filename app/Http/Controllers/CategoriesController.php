<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $category = Category::create($validated);
        return response()->json($category, 201);
    }
    public function show(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category);
    }
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'category not found'], 404);
        }
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $category->update($validated);
        return response()->json($category);
    }
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'category not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'category deleted']);
    }
    public function cercar(string $id)
    {
        // Buscar el actor por ID
        $category = Category::find($id);

        // Si no se encuentra el actor, devolver un error 404
        if (!$category) {
            return response()->json(['message' => 'category no trobat.'], 404);
        }

        // Obtener las películas asociadas al actor
        $peliculas = $category->peliculas()->get();  // Asegurarse de ejecutar la consulta

        // Devolver las películas en formato JSON
        return response()->json($peliculas, 200);  // El código de respuesta es 200 para éxito
    }
}
