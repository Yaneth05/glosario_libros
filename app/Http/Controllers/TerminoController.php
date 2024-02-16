<?php

namespace App\Http\Controllers;

use App\Models\termino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TerminoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //termino cambiarlo si no funciona T
        $datos['terminos']=termino::paginate(20);
        return view('termino.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //para q se pueda ver 
       return view('termino.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Recolectar los datos que envió el formulario
        $datosTermino = request()->except('_token');

        // Truncar la descripción si es demasiado larga
        $descripcion = substr($request->input('descripcion'), 0); // Truncar a 255 caracteres
        $datosTermino['descripcion'] = $descripcion;

        // Manejar la subida de imagen si está presente
        if ($request->hasFile('imagen')) {
            $datosTermino['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }

        // Insertar datos
        Termino::insert($datosTermino);

        // Redirigir con mensaje de éxito
        return redirect('termino')->with('mensaje', '¡Término agregado con éxito 👍!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        $termino = termino::find($id);
    
        if (!$termino) {
            return response()->json(['error' => 'Término no encontrado'], 404);
        }
    
        $imagenURL = null;
        if ($termino->imagen && Storage::exists('public/uploads/' . $termino->imagen)) {
            $imagenURL = asset('storage/uploads/' . $termino->imagen);
        }
    
        return response()->json([
            'termino' => $termino->termino,
            'descripcion' => $termino->descripcion,
            'imagen' => $imagenURL,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $termino=termino::findOrFail($id);
        return view('termino.edit',compact('termino'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $datosTermino = request()->except(['_token','_method']);//recolecta los datos ecepto el token y method

        if ($request->hasFile('imagen')) {
            $termino=termino::findOrFail($id);//recuperar la informacion
            Storage::delete(['public/'.$termino->imagen]);//concatene la imagen y hace el borrado
            $datosTermino['imagen'] = $request->file('imagen')->store('uploads', 'public');//actualizar
        }

        termino::where('id','=',$id)->update($datosTermino);//actualizar la base de datos
        $termino=termino::findOrFail($id);
        return view('termino.edit',compact('termino'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $termino=termino::findOrFail($id);//se busca
        if(Storage::delete('public/'.$termino->imagen)){//si ya se borro fisicamente
            termino::destroy($id);//se destruye por completo
        }
        

        return redirect('termino')->with('mensaje','¡Termino borrado éxitosamente 👍!');
    }
}
