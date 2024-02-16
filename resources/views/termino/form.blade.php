@extends('layouts/template')

@section('contenido')
<main style="background-color: #96D9E7;">
    <br>
    <h1 class="text-center" style="background-color: #96D9E7;">{{ $modo }} termino 💻 </h1>
    <div class="text-center" style="background-color: #96D9E7;"><br>
        <label for="termino">Termino 🗓</label><br>
         <!--validando la informacion-->
        <!--{{ isset($termino->termino)?$termino->termino:'' }}" si existe ese valor imprimelo de lo contrario no pones nada ''-->
        <input type="text" name="termino" value="{{ isset($termino->termino)?$termino->termino:'' }}" id="termino">
    </div>
    
    
        <div class="text-center" style="background-color: #96D9E7;">
            <br>
                <label for="descripcion">Descripción 📝</label><br>
                <!--<input type="text" name="descripcion" value="{{ isset($termino->descripcion)?$termino->descripcion:'' }}" id="descripcion">-->
                <textarea name="descripcion" id="descripcion" rows="4" cols="50" style="background: transparent;">{{ isset($termino->descripcion)?$termino->descripcion:'' }} </textarea>
            <br>
        </div>
            
        <div class="text-center" style="background-color: #96D9E7;">
        <br><br>
            <label for="imagen">Imagen</label>
                @if(isset($termino->imagen))<!--Validacion para la imagen-->
                <img src="{{ asset('storage').'/'.$termino->imagen}}" width="100" alt=""><!--Par q nso muetre la imagen que esta en estorage-->
                @endif
                <input type="file" name="imagen" value="" id="imagen">
                <br><br>
                <input type="submit" value="✏️ {{ $modo }} termino" style="background-color: #CBBDE2; color: #FFFFFF;"> <!--$modo es la variable para que cambie a editar o crear-->
                <br><br>
                <a href="{{ url('termino/') }}">Regresar</a><!--Enlace para regresar etso es para edit ycreate-->
<br>
                <br>
        </div>
   
    
</main>
