@extends('base')
@section('titulo', 'Registrar prestamo')
@section('contenido')
<h3 class="titulo">Registrar préstamo</h3>
        <div class="form mb-3 formulario col-2 mx-auto">
            <form action="{{route('insertarPrestamos')}}" method="post">
                @csrf
                <label class="form-label" for="id_ejemplar">Ejemplar</label>
                <select class="form-select" name="id_ejemplar" id="id_ejemplar">
                    @foreach($ejemplares as $ejemplar)
                    <option value="{{$ejemplar->id}}">{{$ejemplar->titulo}}</option>
                    @endforeach
                </select>

                <label class="form-label" for="id_usuario">Usuario</label>
                <select class="form-select" name="id_usuario" id="id_usuario">
                    @foreach($usuarios as $usuario)
                    <option value="{{$usuario->id}}">{{$usuario->nombre}} {{$usuario->apellidos}}</option>
                    @endforeach
                </select>

                <label class="form-label" for="fecha_inicio">Préstamo</label>
                <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio">

                <label class="form-label" for="fecha_final">Vencimiento</label>
                <input class="form-control" type="date" name="fecha_final" id="fecha_final">

                <button class="btn btn-primary my-3" type="submit">Enviar</button>
            </form>
        </div>
@endsection
