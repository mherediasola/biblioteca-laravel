@extends('base')
@section('titulo', 'Registrarse')
@section('contenido')
<h3 class="titulo">Registrarse</h3>
        <div class="form mb-3 formulario col-2 mx-auto">
            <form action="{{route('formularioRegistro')}}" method="post">
                @csrf
                <label class="form-label" for="user_name">Nombre de usuario</label>
                <input class="form-control" type="text" name="user_name" id="user_name">

                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email">

                <label class="form-label" for="password">Contraseña</label>
                <input class="form-control" type="text" name="password" id="password">

                <label class="form-label" for="rePassword">Repetir contraseña</label>
                <input class="form-control" type="text" name="rePassword" id="rePassword">

                <label class="form-label" for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre" id="nombre">

                <label class="form-label" for="apellidos">Apellidos</label>
                <input class="form-control" type="text" name="apellidos" id="apellidos">

                <button class="btn btn-primary my-3" type="submit">Registrarse</button>
            </form>
        </div>
@endsection
