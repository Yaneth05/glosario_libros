@extends('layouts/template')

@section('contenido')
<main style="background-color: #96D9E7;">
    <br>
    <h1 class="text-center" style="background-color: #96D9E7;">{{ $modo }} nuevo libro 💻 </h1>
    <div class="text-center" style="background-color: #96D9E7;"><br>
        <label for="nombre">Nombre 📝</label><br>
         <!--validando la informacion-->
        <!--{{ isset($termino->nombre)?$termino->nombre:'' }}" si existe ese valor imprimelo de lo contrario no pones nada ''-->
        <input type="text" name="nombre" value="{{ isset($termino->nombre)?$termino->nombre:'' }}" id="nombre">
    </div>
    
    <div class="text-center" style="background-color: #96D9E7;"><br>
        <label for="autor">Autor 📝</label><br>
        <!--<input type="text" name="autor" value="{{ isset($termino->autor)?$termino->autor:'' }}" id="autor">-->
        <textarea name="autor" id="autor" rows="4" cols="50" style="background: transparent;">{{ isset($termino->autor)?$termino->autor:'' }} </textarea>
        <br>
    </div>
    
    <div class="text-center" style="background-color: #96D9E7;">
        <br><br>
        <label for="fechaPublicacion">Fecha de Publicación 📅</label><br>
        <input type="text" name="fechaPublicacion" value="{{ isset($termino->fechaPublicacion)?$termino->fechaPublicacion:'' }}" id="fechaPublicacion">
        <br>
    </div>
    
    <div class="text-center" style="background-color: #96D9E7;">
        <br><br>
        <label for="editorial">Editorial 📚</label><br>
        <input type="text" name="editorial" value="{{ isset($termino->editorial)?$termino->editorial:'' }}" id="editorial">
        <br>
    </div>
    
    <div class="text-center" style="background-color: #96D9E7;">
        <br><br>
        <label for="imagen">Portada</label>
        @if(isset($termino->imagen))<!--Validacion para la imagen-->
            <img src="{{ asset('storage').'/'.$termino->imagen}}" width="100" alt=""><!--Para que nos muestre la imagen que está en storage-->
        @endif
        <input type="file" name="imagen" value="" id="imagen">
        <br><br>
        <input type="submit" value="✏️ {{ $modo }} libro" style="background-color: #CBBDE2; color: #FFFFFF;"> <!--$modo es la variable para que cambie a editar o crear-->
        <br><br>
        <a href="{{ url('termino/') }}">Regresar</a><!--Enlace para regresar, esto es para editar y crear-->
        <br><br>
    </div>
</main>
@endsection
