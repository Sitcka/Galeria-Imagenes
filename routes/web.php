<?php

use App\Http\Controllers\CommentImageController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\CommentImage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::resource('/imagen', ImageController::class)->middleware(['auth', 'verified']);
Route::middleware('auth')->group(function () {
    Route::resource('/comentario', CommentImageController::class);
    Route::resource('/galeria', GaleryController::class);
    Route::get('/comentario/{id}/comentariosImagen', [CommentImageController::class, 'comentariosImagen'])->name('comentario.comentariosImagen');
    // Esto para poder añadir una imagen a una Galeria ya existente de la tabla pivote
    Route::post('/galeria/{id}/añadirImagenes', [GaleryController::class, 'añadirImagenes'])->name('galeria.añadirImagenes');
    // Creo una ruta para poder eliminar una imagen de la galeria de la tabla pivote, es decir un registro de aquella tabla
    Route::delete('/galeria/{id}/eliminarImagen', [GaleryController::class, 'eliminarImagen'])->name('galeria.eliminarImagen');
    Route::resource('/usuario', UserController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('galeria_imagenes.usuario.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('galeria_imagenes.usuario.configuracion.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('galeria_imagenes.usuario.configuracion.destroy');
});

require __DIR__ . '/auth.php';
