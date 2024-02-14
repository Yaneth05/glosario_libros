Formulario de creacion de termino
<!--Creacion del formulario-->
<!--Para poder capturar imagnes o subir archivos--enctype="multipart/form-data"-->
<form action="{{ url('/termino') }}" method="post" enctype="multipart/form-data">
    @csrf <!--imprime una llave de seguridad-->
    
    @include('termino.form',['modo'=>'Crear']);
</form>