<?php

use App\Http\Controllers\ActoresController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Pelicula;
use App\Http\Controllers\PeliculasController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('peliculas')->group(function () {
    // Listar todas las tareas
    Route::get('/', [PeliculasController::class, 'index']); // GET /tasks
    // Mostrar una tarea específica
    Route::get('/{id}', [PeliculasController::class, 'show']); // GET /tasks/{id}
    // Crear una nueva tarea
    Route::post('/', [PeliculasController::class, 'store']); // POST /tasks
    // Actualizar una tarea existente
    Route::put('/{id}', [PeliculasController::class, 'update']); // PUT /tasks/{id}
    // Eliminar una tarea
    Route::delete('/{id}', [PeliculasController::class, 'destroy']);  // DELETE /tasks/{id}
    Route::post('/cercaCombinada', [PeliculasController::class, 'cercaCombinada']);
    Route::post('/peliculaDetalle/{id}', [PeliculasController::class, 'detallePelicula']);
});

Route::prefix('actores')->group(function () {
    // Listar todas las tareas
    Route::get('/', [ActoresController::class, 'index']); // GET /tasks
    // Mostrar una tarea específica
    Route::get('/{id}', [ActoresController::class, 'show']); // GET /tasks/{id}
    // Crear una nueva tarea
    Route::post('/', [ActoresController::class, 'store']); // POST /tasks
    // Actualizar una tarea existente
    Route::put('/{id}', [ActoresController::class, 'update']); // PUT /tasks/{id}
    // Eliminar una tarea
    Route::delete('/{id}', [ActoresController::class, 'destroy']); // DELETE /tasks/{id}
    Route::post('/{id}', [ActoresController::class, 'cercar']); // cercar 
});

Route::prefix('categories')->group(function () {
    // Listar todas las tareas
    Route::get('/', [CategoriesController::class, 'index']); // GET /tasks
    // Mostrar una tarea específica
    Route::get('/{id}', [CategoriesController::class, 'show']); // GET /tasks/{id}
    // Crear una nueva tarea
    Route::post('/', [CategoriesController::class, 'store']); // POST /tasks
    // Actualizar una tarea existente
    Route::put('/{id}', [CategoriesController::class, 'update']); // PUT /tasks/{id}
    // Eliminar una tarea
    Route::delete('/{id}', [CategoriesController::class, 'destroy']); // DELETE /tasks/{id}
    Route::post('/{id}', [CategoriesController::class, 'cercar']); // cercar 
});
