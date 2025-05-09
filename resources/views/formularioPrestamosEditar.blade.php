@extends('base')
@section('titulo', 'Editar prestamo')
@section('contenido')
<h3 class="titulo">Editar préstamo</h3>
        <div class="form mb-3 formulario col-2 mx-auto">
            <form action="{{route('mostrarEditarPrestamos', $prestamo->id)}}" method="post">
                @csrf
                <label class="form-label" for="id_ejemplar">Ejemplar</label>
                <select class="form-select" name="id_ejemplar" id="id_ejemplar">
                    @foreach($ejemplares as $ejemplar)
                    <option value="{{$ejemplar->id}}" {{$ejemplar->id == $prestamo->id_ejemplar ? 'selected' : ''}}>
                        {{$ejemplar->titulo}}
                    </option>
                    @endforeach
                </select>

                <label class="form-label" for="id_usuario">Usuario</label>
                <select class="form-select" name="id_usuario" id="id_usuario">
                    @foreach($usuarios as $usuario)
                    <option value="{{$usuario->id}}" {{$usuario->id == $prestamo->id_usuario ? 'selected': ''}}>
                        {{$usuario->nombre}}  {{$usuario->apellidos}}
                    </option>
                    @endforeach
                </select>

                <label class="form-label" for="fecha_inicio">Préstamo</label>
                <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio" value="{{$prestamo->fecha_inicio}}">

                <label class="form-label" for="fecha_final">Vencimiento</label>
                <input class="form-control" type="date" name="fecha_final" id="fecha_final" value="{{$prestamo->fecha_final}}">

                <button class="btn btn-primary my-3" type="submit">Enviar</button>
            </form>
        </div>
@endsection
