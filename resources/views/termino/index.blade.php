

@if(Session::has('mensaje'))<!--Si tiene un mensaje-->
    {{Session::get('mensaje')}}<!--muestra el emsaje-->
@endif

@extends('layouts/template')

@section('contenido')

<main> 
    <div id= "header" class="col-12 bg-custom-color" style="height: 14%; background-color: #563D7D;">
        <h3 class="text-center text-white">Glosario Sistemas Cliente-Servidor</h3>
        <h4 class="text-center text-white">Universidad Politecnica de Bacalar</h4>
        <h6 class="text-center text-white">Act 1.8 Programación Cliente Servidor</h6>
            
        </nav>
    </div>

    <div class="row" style="height: 86%;"> 
        <div id="menu" class="col-2" style="max-height: 100%; overflow-y: auto; background-color: #CBBDE2;">
            <form id="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!--Grupo de botones en vertical-->
                    <div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">
                        <!--Boton 1-->
                        @csrf
                    @foreach($terminos as $termino)
                    
                    &nbsp;
                        <input type="radio" class="btn-check btn-lg" name="vbtn-radio" id="vbtn-radio{{ $termino->id }}" data-id="{{ $termino->id}}" autocomplete="off" {{$termino->id == 1 ? 'checked' : ''}}>
                        <label class="btn btn-outline-success btn-lg" for="vbtn-radio{{ $termino->id }}">{{ $termino->termino }} 💻</label>
                    @endforeach
                    </div>
            </form>
        
    </div>
        <div id="contenido"class="col-10 text-center bd-light">
          
           <br>
           <br><br>
            <div class="col-12 ml-2" style="background-color: #CBBDE2;"><!--Columna de contenido actualizable-->
<br><br>
              <h1 class="text-green"> {{ $termino->termino }}</h1>
              <hr>
              <br>
              <p class="h2 text-green"> {{ $termino->descripcion }} </p>
              <br>
              <hr>
<br>
              <div class="container" style="max-width: 500px;">
              <img class="img-fluid" src="{{ $termino->imagen ? asset('storage/uploads/' . $termino->imagen) : '' }}" alt="Imagen del término" id="term-image"><br>
<br>
              <td>   
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/termino/'.$termino->id.'/edit') }}">Editar</a>
                    <form action="{{ url('/termino/'.$termino->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Seguro que deseas borrar el término?')" value="Borrar ❌">
                    </form>
                </div>

            </td>
              
              </div>
              <br>
              
              <a href="{{ url('termino/create') }}" class="btn btn-outline-primary"> 🔖 Registrar nuevo Termino</a>

              
              <br>
            </div><!--Fin de la columna de contenido actualizable-->
        </div>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            // Cuando se cambia el valor de un botón radio
            $('input[name="vbtn-radio"]').change(function(){
                // Obtiene el valor del botón radio marcado
                var id = $('input[name="vbtn-radio"]:checked').data('id');
                // Envía una petición ajax a la ruta /glosario con el id como parámetro
                $.ajax({
                    url: '{{ route('index.ajax') }}',
                    type: 'POST',
                    data: {id: id,_token: $('input[name="_token"]').val()},
                    // Si la petición es exitosa
                    success: function(data){
                        // Actualiza el contenido de los elementos <h1> y <p> con el nombre y la descripción del término
                        $('h1').text(data.termino);
                        $('p').text(data.descripcion);
                        $('#term-image').attr('src', data.imagen);
                    }
                });
            });
        });
    </script>

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