<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'titulo' => 'required | regex:/[a-zA-Z]+/ | max:100',
            'descripcion' => ['nullable', 'regex:/[a-zA-Z]+/'],
            'usuario_id' => ['required', 'numeric'],
            'imagenes' => ['nullable', 'array']
        ]);
        $galeria = Galery::create($request->only(['titulo', 'descripcion', 'usuario_id'])); //Crea y guarda en la base de datos un nuevo objeto
        if ($request->has('imagenes')) {
            $galeria->imagenes()->attach($request->imagenes);
        }
        return redirect()->route('usuario.show', auth()->user()->id); //Esto es para enviar el id del usuario que se halla logeado.


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $galeria = Galery::findOrFail($id);
        return view('galeria_imagenes.galeria.show', compact('galeria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galery $galery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titulo' => 'required | regex:/[a-zA-Z]+/ | max:100',
            'descripcion' => ['nullable', 'regex:/[a-zA-Z]+/'],
            'usuario_id' => ['required', 'numeric'],
        ]);
        $galeria = Galery::findOrFail($id);
        $galeria->update($request->all());
        return redirect()->route('usuario.show', auth()->user()->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $galeria = Galery::findOrFail($id);
        $galeria->delete();
        return redirect()->route('usuario.show', auth()->user()->id);
    }
    /**
     * 
     * Funcion para añadir imagenes a una galeria creada anteriormente, 
     * pero solo con imagenes que ya existan del usuario
     * Esto perteneciente a la tabla pivote
     * 
     */
    public function añadirImagenes(Request $request, string $id)
    {
        $galeria = Galery::findOrFail($id);
        if ($request->has('imagenes')) {
            $galeria->imagenes()->attach($request->imagenes);
            return redirect()->route('galeria.show', $galeria->id);
        }
    }

    /**
     * Funcion para eliminar una imagen de la galeria, solamente de la galeria
     * Esto perteneciente a la tabla pivote
     */
    public function eliminarImagen(Request $request, string $id)
    {
        $galeria = Galery::findOrFail($id);
        $galeria->imagenes()->detach($request->image_id);
        return redirect()->back();
    }
}
