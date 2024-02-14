<?php

namespace App\Http\Controllers;

use App\Models\termino;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class TerminoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //termino cambiarlo si no funciona T
        $datos['terminos']=termino::paginate(5);
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
        //Se retornan los datos que envio el formulario
        //$datosTermino = request()->all();
        $datosTermino = request()->except('_token');//recolecta toda la informcion excepto el token(valor de seguridad)

        if ($request->hasFile('imagen')) {
            $datosTermino['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }
        
    
        termino::insert($datosTermino);//para insertar datos
        //return response()->json($datosTermino);//retornar un json(toda la informacion)
        return redirect('termino')->with('mensaje','¡Termino agregado con éxito 👍!');//nos retorna a index en mensaje y l¿tira el mensaje
    }

    /**
     * Display the specified resource.
     */
    public function show(termino $termino)
    {
        //
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
