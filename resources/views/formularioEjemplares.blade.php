@extends('base')
@section('titulo', 'Registrar ejemplar')
@section('contenido')
<h3 class="titulo">Registrar ejemplar</h3>
        <div class="form mb-3 formulario col-2 mx-auto">
            <form action="{{route('insertarEjemplares')}}" method="post">
                @csrf
                <label class="form-label" for="titulo">Título</label>
                <input class="form-control" type="text" name="titulo" id="titulo">

                <label class="form-label" for="autor">Autor</label>
                <input class="form-control" type="text" name="autor" id="autor">

                <label class="form-label" for="titulo">Tipo</label>
                <select class="form-select" name="tipo" id="tipo">
                    @foreach($tipos as $tipo)
                    <option value="{{ $tipo->value }}">{{ $tipo->name }}</option>
                    @endforeach
                </select>

                <label class="form-label" for="idioma">Idioma</label>
                <input class="form-control" type="text" name="idioma" id="idioma">

                <label class="form-label" for="editorial">Editorial</label>
                <input class="form-control" type="text" name="editorial" id="editorial">

                <button class="btn btn-primary my-3" type="submit">Enviar</button>
            </form>
        </div>
@endsection