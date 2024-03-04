@if(Session::has('mensaje'))
    {{Session::get('mensaje')}}
@endif

@extends('layouts/template')

@section('contenido')

<main> 
    <div id="header" class="col-12 bg-custom-color" style="height: 14%; background-color: #563D7D;">
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto d-flex align-items-center">
                    <!-- Logo -->
                    <br>
                    <br><br><br>
                    <div style="font-size: 30px; margin-right: 10px;">🏢</div>
                    <h3 class="text-center text-white d-inline-block ml-2">Sistema de biblioteca</h3>
                    <br><br>
                    <br>
                </div>
                <div class="col-auto">
                    <!-- INICIO Formulario de búsqueda -->
                    <form id="form-busqueda" class="form-inline" action="{{ route('buscar') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input class="form-control mr-1" type="search" placeholder="nombre o autor" aria-label="Buscar" name="termino">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit">Buscar</button>
                            </div>
                        </div>
                    </form>
                    <!-- FIN Formulario de búsqueda -->
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="height: 86%;"> 
        <div id="menu" class="col-2" style="max-height: 100%; overflow-y: auto; background-color: #CBBDE2;">
            <!-- Grupo de botones en vertical -->
            <div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">
                <!-- Botón Listar libros -->
                <button type="button" class="btn btn-outline-primary btn-lg" id="listar-libros">Listar libros</button>
                <!-- Botón Administrar libros -->
                <button type="button" class="btn btn-outline-success btn-lg" id="administrar-libros">Administrar libros</button>
            </div>
        </div>

        <div id="contenido" class="col-10 text-center bd-light">
            <br>
            <br>
            <br>
            <div class="col-12 ml-2" style="background-color: #CBBDE2;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Nombre</th>
                            <th>Autor</th>
                            <th>Fecha de Publicación</th>
                            <th>Editorial</th>
                            <th>Imagen</th>
                            <th id="acciones-th">Acciones</th> <!-- Columna de acciones -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($terminos as $termino)
                            <tr>
                                <td>{{ $termino->id }}</td>
                                <td>{{ $termino->nombre }}</td>
                                <td>{{ $termino->autor }}</td>
                                <td>{{ $termino->fechaPublicacion }}</td>
                                <td>{{ $termino->editorial }}</td>
                                <td><img src="{{ $termino->imagen ? asset('storage/uploads/' . $termino->imagen) : '' }}" alt="Imagen" style="max-width: 100px;"></td>
                                <td id="acciones">
                                    <!-- Botones de editar y eliminar -->
                                    <a href="{{ url('/termino/'.$termino->id.'/edit') }}">Editar</a>
                                    <form action="{{ url('/termino/'.$termino->id) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <input type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Seguro que deseas borrar el libro?')" value="Borrar ❌">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <a href="{{ url('termino/create') }}" class="btn btn-outline-primary"> 🔖 Registrar nuevo Libro</a>
            </div>
        </div>
    </div>
</main>

<footer style="background-color: #563D7D; color: white; padding: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>UPB | IS | Prog. Cliente-Serv | Angela Cruz Mendoza-Chelsea Hernandez Ceja | 02/03/2024</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        // Mostrar tabla con botones de editar y eliminar al inicio
        mostrarColumnaAcciones(true);

        // Cuando se hace clic en "Listar libros"
        $('#listar-libros').click(function(){
            mostrarColumnaAcciones(false);
        });

        // Cuando se hace clic en "Administrar libros"
        $('#administrar-libros').click(function(){
            mostrarColumnaAcciones(true);
        });

        // Función para mostrar u ocultar la columna de acciones
        function mostrarColumnaAcciones(mostrar){
            if(mostrar){
                $('#acciones-th').show();
                $('tbody tr').each(function(){
                    $(this).find('#acciones').show();
                });
            } else {
                $('#acciones-th').hide();
                $('tbody tr').each(function(){
                    $(this).find('#acciones').hide();
                });
            }
        }
    });
</script>

@endsection



<!--<a href="{{ url('termino/create') }}">Registrar nuevo Termino</a>Enlace para registar

<table class="table table-light">
    <thead>
        <tr> 
            <th>Concepto</th>
            <th>Definicion</th>
            <th>Imagen</th>        
        </tr>
    </thead>

    <tbody>
        @foreach($terminos as $termino)
        <tr>
            <td> {{ $termino->termino }} </td>
            <td> {{ $termino->descripcion }} </td>
            <td>
                <img src="{{ asset('storage').'/'.$termino->imagen}}" width="100" alt="">--> <!--Par q nso muetre la imagen que esta en estorage
            </td>
            
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
</table> -->