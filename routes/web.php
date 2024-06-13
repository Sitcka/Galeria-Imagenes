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




Route::resource('/usuario', UserController::class)->middleware(['auth','verified']);
Route::resource('/imagen', ImageController::class)->middleware(['auth', 'verified']);
Route::put('/imagen/{id}/editarImagenGaleria', [ImageController::class, 'editarImagenGaleria'])->name('imagen.editarImagenGaleria');
Route::middleware('auth')->group(function () {
    Route::resource('/comentario', CommentImageController::class);
    Route::resource('/galeria', GaleryController::class);
    // Ruta para convertirse en premium
    Route::post('/premium', [UserController::class, 'actualizarPremium'])->name('user.actualizarPremium');
    Route::get('/comentario/{id}/comentariosImagen', [CommentImageController::class, 'comentariosImagen'])->name('comentario.comentariosImagen');
    // Esto para poder añadir una imagen a una Galeria ya existente de la tabla pivote
    Route::post('/galeria/{id}/agregarImagenes', [GaleryController::class, 'agregarImagenes'])->name('galeria.agregarImagenes');
    // Creo una ruta para poder eliminar una imagen de la galeria de la tabla pivote, es decir un registro de aquella tabla
    Route::delete('/galeria/{id}/eliminarImagen', [GaleryController::class, 'eliminarImagen'])->name('galeria.eliminarImagen');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('galeria_imagenes.usuario.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('galeria_imagenes.usuario.configuracion.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('galeria_imagenes.usuario.configuracion.destroy');
});

require __DIR__ . '/auth.php';
