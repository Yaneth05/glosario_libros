
@extends('layouts/template')

@section('contenido')
<!--Creacion del formulario-->
<!--Para poder capturar imagnes o subir archivos--enctype="multipart/form-data"-->
<main>

    <div id= "header" class="col-12 bg-custom-color" style="height: 14%; background-color: #563D7D;">
        <h3 class="text-center text-white">Glosario Sistemas Cliente-Servidor</h3>
        <h4 class="text-center text-white">Universidad Politecnica de Bacalar</h4>
        <h6 class="text-center text-white">Act 1.8 Programación Cliente Servidor</h6>
            
        </nav>
    </div><br>

    <form action="{{ url('/termino') }}" method="post" enctype="multipart/form-data">
        @csrf <!--imprime una llave de seguridad-->
        
        @include('termino.form',['modo'=>'Crear']);
    
    </form>
</main>
