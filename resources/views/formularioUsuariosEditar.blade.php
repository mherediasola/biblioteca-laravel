@extends('base')
@section('titulo', 'Editar usuario')
@section('contenido')
<h3 class="titulo">Editar usuario</h3>
        <div class="form mb-3 formulario col-2 mx-auto">
            <form action="{{route('mostrarEditarUsuarios', $usuario->id)}}" method="post">
                @csrf
                <label class="form-label" for="rol">Rol</label>
                <select class="form-select" name="rol" id="rol">
                    @foreach($roles as $rol)
                    <option value="{{$rol->id}}"{{$rol->id == $usuario->id_rol ? 'selected' : ''}}>
                        {{$rol->tipo}}
                    </option>
                    @endforeach
                </select>

                <label class="form-label" for="user_name">Nombre de usuario</label>
                <input class="form-control" type="text" name="user_name" id="user_name" value="{{$usuario->user_name}}">

                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" value="{{$usuario->email}}">


                <label class="form-label" for="password">Contraseña</label>
                <input class="form-control" type="text" name="password" id="password" value="{{$usuario->password}}">

                <label class="form-label" for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre" id="nombre" value="{{$usuario->nombre}}">

                <label class="form-label" for="apellidos">Apellidos</label>
                <input class="form-control" type="text" name="apellidos" id="apellidos" value="{{$usuario->apellidos}}">

                <button class="btn btn-primary my-3" type="submit">Enviar</button>
            </form>
        </div>
@endsection
