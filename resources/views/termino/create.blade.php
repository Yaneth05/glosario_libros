
@extends('layouts/template')

@section('contenido')
<!--Creacion del formulario-->
<!--Para poder capturar imagnes o subir archivos--enctype="multipart/form-data"-->
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

    <form action="{{ url('/termino') }}" method="post" enctype="multipart/form-data">
        @csrf <!--imprime una llave de seguridad-->
        
        @include('termino.form',['modo'=>'Crear']);
    
    </form>
</main>
