@extends('base')
@section('titulo', 'Buscar préstamos')
@section('contenido')
<h1 class="titulo">Préstamos</h1>
<div class="tabla" >
    <div>
        <a href="{{route('prestamos')}}" class="btn btn-primary mb-3">
            <i class="fa-solid fa-left-long"></i> Volver
        </a>
    </div>
    <table class="tRoles table table-striped table-hover">
        <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Ejemplar</th>
            <th>Autor(es)</th>
            <th>Préstamo</th>
            <th>Vencimiento</th>
        </tr>
        <tr>
            <td>{{ $prestamo->id }}</td>
            <td>{{ $prestamo->usuario }}</td>
            <td>{{ $prestamo->nombre }}</td>
            <td>{{ $prestamo->ejemplar }}</td>
            <td>{{ $prestamo->autor }}</td>
            <td>{{ $prestamo->prestamo }}</td>
            <td>{{ $prestamo->vencimiento }}</td>
        </tr>
    </table>
</div>
@endsection
