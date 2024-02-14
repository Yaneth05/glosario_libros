Formulario de ediion de termino

<form action="{{ url('/termino/'.$termino->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}

    @include('termino.form',['modo'=>'Editar']);

</form>

