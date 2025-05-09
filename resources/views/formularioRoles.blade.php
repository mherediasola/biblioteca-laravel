@extends('base')
@section('titulo', 'Registrar rol')
@section('contenido')
<h3 class="titulo">Registrar rol</h3>
        <div class="form mb-3 formulario col-2 mx-auto">
            <form action="{{route('insertarRoles')}}" method="post">
                @csrf
                <label class="form-label" for="tipo">Tipo</label>
                <input class="form-control" type="text" name="tipo" id="tipo">
                <button class="btn btn-primary my-3" type="submit">Enviar</button>
            </form>
        </div>
@endsection

