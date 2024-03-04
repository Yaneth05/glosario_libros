<?php

namespace App\Http\Controllers;

use App\Models\Termino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TerminoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terminos = Termino::paginate(20);
        return view('termino.index', compact('terminos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('termino.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'fechaPublicacion' => 'required|string|max:255',
            'editorial' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $termino = new Termino();
        $termino->nombre = $request->nombre;
        $termino->autor = $request->autor;
        $termino->fechaPublicacion = $request->fechaPublicacion;
        $termino->editorial = $request->editorial;

        if ($request->hasFile('imagen')) {
            $termino->imagen = $request->file('imagen')->store('uploads', 'public');
        }

        $termino->save();

        return redirect('termino')->with('mensaje', '¡Término agregado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        $termino = Termino::find($id);

        if (!$termino) {
            return response()->json(['error' => 'Término no encontrado'], 404);
        }

        $imagenURL = null;
        if ($termino->imagen && Storage::exists('public/' . $termino->imagen)) {
            $imagenURL = asset('storage/' . $termino->imagen);
        }

        return response()->json([
            'nombre' => $termino->nombre,
            'autor' => $termino->autor,
            'fechaPublicacion' => $termino->fechaPublicacion,
            'editorial' => $termino->editorial,
            'imagen' => $imagenURL,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $termino = Termino::findOrFail($id);
        return view('termino.edit', compact('termino'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'fechaPublicacion' => 'required|string|max:255',
            'editorial' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $termino = Termino::findOrFail($id);
        $termino->nombre = $request->nombre;
        $termino->autor = $request->autor;
        $termino->fechaPublicacion = $request->fechaPublicacion;
        $termino->editorial = $request->editorial;

        if ($request->hasFile('imagen')) {
            Storage::delete(['public/' . $termino->imagen]);
            $termino->imagen = $request->file('imagen')->store('uploads', 'public');
        }

        $termino->save();

        return redirect('termino')->with('mensaje', '¡Término actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $termino = Termino::findOrFail($id);

        if ($termino->imagen && Storage::exists('public/' . $termino->imagen)) {
            Storage::delete('public/' . $termino->imagen);
        }

        $termino->delete();

        return redirect('termino')->with('mensaje', '¡Término eliminado exitosamente!');
    }

    //esto es para la funcion buscar
    public function buscar(Request $request) {
        $termino = $request->input('termino');
        $terminos = Termino::where('nombre', 'LIKE', "%$termino%")
                            ->orWhere('autor', 'LIKE', "%$termino%")
                            ->get();
    
        return view('termino.index', ['terminos' => $terminos]);
    }
}
