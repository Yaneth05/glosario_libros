<h1>{{ $modo }} termino</h1>

<label for="termino">Termino</label>
<!--validando la informacion-->
<!--{{ isset($termino->termino)?$termino->termino:'' }}" si existe ese valor imprimelo de lo contrario no pones nada ''-->
<input type="text" name="termino" value="{{ isset($termino->termino)?$termino->termino:'' }}" id="termino">
<br>
<label for="descripcion">Descripción</label>
<input type="text" name="descripcion" value="{{ isset($termino->descripcion)?$termino->descripcion:'' }}" id="descripcion">
<br>
<label for="imagen">Imagen</label>
@if(isset($termino->imagen))<!--Validacion para la imagen-->
<img src="{{ asset('storage').'/'.$termino->imagen}}" width="100" alt=""><!--Par q nso muetre la imagen que esta en estorage-->
@endif
<input type="file" name="imagen" value="" id="imagen">
<br>
<input type="submit" value="{{ $modo }} termino"> <!--$modo es la variable para que cambie a editar o crear-->

<a href="{{ url('termino/') }}">Regresar</a><!--Enlace para regresar etso es para edit ycreate-->

<br>