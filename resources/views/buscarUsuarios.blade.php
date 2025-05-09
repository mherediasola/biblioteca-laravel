@extends('base')
@section('titulo', 'Buscar usuario')
@section('contenido')
<h1 class="titulo">Usuarios</h1>
<div class="tabla" >
    <div>
        <a href="{{route('usuarios')}}" class="btn btn-primary mb-3">
            <i class="fa-solid fa-left-long"></i> Volver
        </a>
    </div>
    <table class="tRoles table table-striped table-hover">
        <tr>
            <th>Id</th>
            <th>Rol</th>
            <th>Nombre de usuario</th>
            <th>Email</th>
            <th>Nombre</th>
            <th>Apellidos</th>
        </tr>
        <tr>
            <td>{{$usuario->id}}</td>
            <td>{{$usuario->roles->tipo}}</td>
            <td>{{$usuario->user_name}}</td>
            <td>{{$usuario->email}}</td>
            <td>{{$usuario->nombre}}</td>
            <td>{{$usuario->apellidos}}</td>
        </tr>
    </table>
</div>
@endsection