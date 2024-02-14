Mostrar la lista de terminos

@if(Session::has('mensaje'))<!--Si tiene un mensaje-->
    {{Session::get('mensaje')}}<!--muestra el emsaje-->
@endif

<a href="{{ url('termino/create') }}">Registrar nuevo Termino</a><!--Enlace para registar-->

<table class="table table-light">
    <thead>
        <tr>
            <th>#</th><!--es el id-->
            <th>Imagen</th>
            <th>Termino</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($terminos as $termino)
        <tr>
            <td></td>
            <td> {{ $termino->id }} </td>
            <td>
                <img src="{{ asset('storage').'/'.$termino->imagen}}" width="100" alt=""><!--Par q nso muetre la imagen que esta en estorage-->
            </td>
            <td> {{ $termino->termino }} </td>
            <td> {{ $termino->descripcion }} </td>
            <td> 
                <a href="{{ url('/termino/'.$termino->id.'/edit') }}">
                    Editar
                </a>
                | 
                <form action="{{ url('/termino/'.$termino->id) }}" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" onclick="return confirm('¿Seguro que deseas borrar el termino?')" 
                    value="Borrar">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>