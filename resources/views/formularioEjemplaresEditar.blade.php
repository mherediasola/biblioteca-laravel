@extends('base')
@section('titulo', 'Editar ejemplar')
@section('contenido')
<h3 class="titulo">Editar ejemplar</h3>
        <div class="form mb-3 formulario col-2 mx-auto">
            <form action="{{route('mostrarEditarEjemplares', $ejemplar->id)}}" method="post">
                @csrf
                <label class="form-label" for="titulo">Título</label>
                <input class="form-control" type="text" name="titulo" id="titulo" value="{{$ejemplar->titulo}}">

                <label class="form-label" for="autor">Autor</label>
                <input class="form-control" type="text" name="autor" id="autor" value="{{$ejemplar->autor}}">

                <label class="form-label" for="titulo">Tipo</label>
                <select class="form-select" name="tipo" id="tipo">
                    @foreach($tipos as $tipo)
                    <option value="{{ $tipo->value }}" {{$tipo->value == $ejemplar->tipo ? 'selected' : '' }}>
                        {{ $tipo->name }}
                    </option>
                    @endforeach
                </select>

                <label class="form-label" for="idioma">Idioma</label>
                <input class="form-control" type="text" name="idioma" id="idioma" value="{{$ejemplar->idioma}}">

                <label class="form-label" for="editorial">Editorial</label>
                <input class="form-control" type="text" name="editorial" id="editorial" value="{{$ejemplar->editorial}}">

                <button class="btn btn-primary my-3" type="submit">Enviar</button>
            </form>
        </div>
@endsection
