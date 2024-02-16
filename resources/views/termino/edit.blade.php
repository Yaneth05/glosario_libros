
@extends('layouts/template')

@section('contenido')

<main>

    <div id= "header" class="col-12 bg-custom-color" style="height: 14%; background-color: #563D7D;">
        <h3 class="text-center text-white">Glosario Sistemas Cliente-Servidor</h3>
        <h4 class="text-center text-white">Universidad Politecnica de Bacalar</h4>
        <h6 class="text-center text-white">Act 1.8 Programación Cliente Servidor</h6>
            
        </nav>
    </div><br>

    <form action="{{ url('/termino/'.$termino->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}

        @include('termino.form',['modo'=>'Editar']);

    </form>
</main>


