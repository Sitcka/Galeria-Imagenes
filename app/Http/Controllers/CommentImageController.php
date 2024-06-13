<?php

namespace App\Http\Controllers;

use App\Models\CommentImage;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $comentarios = CommentImage::all();
        // return view('galeria_imagenes.imagen.index', compact('comentarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'texto' => 'required | regex:/[a-zA-Z0-9]+/ | max:170',
            'usuario_id' => 'required | numeric',
            'imagen_id' => 'required | numeric'
        ]);
        $comentario = CommentImage::create($request->all());
        $usuario = User::findOrFail($comentario->usuario_id);
        $data = [
            'created_at' => $comentario->created_at,
            'texto' => $comentario->texto,
            'id' => $comentario->id,
            'usuario' => $usuario
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comentario = CommentImage::find($id);
        if (!$comentario) {
            response()->json([
                'success' => false,
                'message' => 'No se encontro el comentario'
            ], 404)->send();
            die();
        }
        // Para que solo el mismo usuario pueda eliminar el comentario
        if ($comentario->usuario_id !== auth()->id()) {
            return response()->json([
                'success' => false, 
                'message' => 'No tienes permiso para eliminar este comentario.'
            ], 403);
        }

        try {
            $comentario->delete();
            return response()->json([
                'success' => true,
                'message' => 'Comentario eliminado correctamente']);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'error',
                'message' => 'Borrado fallido', 
                'error_message' => $th->getMessage()
            ], 409);
        }
    }

    /**
     * Devueve los comentarios que tenga cada imagen
     */
    public function comentariosImagen(string $id){
        $imagen = Image::findOrFail($id);
        $comentarios = $imagen->comentariosImagen();
       return response()->json($comentarios);
    }
}
