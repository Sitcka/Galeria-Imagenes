<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $imagenes = Image::all();

        return view('galeria_imagenes.imagen.index', compact('imagenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // return view(('galeria_imagenes.imagen.create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'titulo' => 'required | regex:/[a-zA-Z]+/ | max:60', //Con la expresion regular podremos controlar que el titulo sea letras y no numeros
            'descripcion' => ['nullable', 'regex:/[a-zA-Z]+/'], //Esta es otra manera de sintaxis
            'path' => 'required | image | mimes:jpeg,png,svg | max:1100', //Se suele usar mas numeric y gt minimo y lte maximo
            'fecha_subida' => ['required', 'date'],
            'usuario_id' => ['required', 'numeric']

        ]);
        if ($request->hasFile('path')) {
            $ruta = $request->file('path')->store('img', 'public');
            $imagen = new Image();
            $imagen->titulo = $request->titulo;
            $imagen->descripcion = $request->descripcion;
            $imagen->path = $ruta; // Guardar la ruta en la base de datos
            $imagen->fecha_subida = $request->fecha_subida;
            $imagen->usuario_id = $request->usuario_id;
            $imagen->save();
        }
        return redirect()->route('imagen.index');
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
        // Validar los datos recibidos
        $request->validate([
            'titulo' => 'required|regex:/[a-zA-Z]+/|max:60',
            'descripcion' => 'nullable|regex:/[a-zA-Z]+/',
            'fecha_subida' => 'required|date',
            'usuario_id' => 'required|numeric',
            'path' => 'required', // La validación 'sometimes' permite que el campo sea opcional
        ]);

        // Encontrar la imagen por ID
        $imagen = Image::find($id);
        // Actualizar los campos con los datos recibidos
        $imagen->titulo = $request->titulo;
        $imagen->descripcion = $request->descripcion;
        $imagen->fecha_subida = $request->fecha_subida;
        $imagen->usuario_id = $request->usuario_id;
        $imagen->path = $request->path;

        // Guardar los cambios en la base de datos
        $imagen->update();
        if (strcmp($request->es, "usuario") !== 0) {
            return redirect()->route('galeria.show', $request->galeria_id);
        } else {
            return redirect()->route('usuario.show', $imagen->usuario_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagen = Image::find($id);
        // Podria usar directamente delete, sin embargo la funcion disk() especifica el l ugar donde se almaceno las imagenes.
        // Lo que hare primeramente es saber si 
        if (Storage::disk('public')->exists($imagen->path)) {
            // En ese caso se eliminara la imagen, la cual esta almacenada localmente
            Storage::disk('public')->delete(($imagen->path));
            $imagen->delete();
            return redirect()->route('usuario.show', auth()->user()->id);
        }
    }
}
