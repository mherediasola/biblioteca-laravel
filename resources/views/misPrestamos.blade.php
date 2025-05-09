@extends('base')
@section('titulo', 'Préstamos')
@section('contenido')
<h1 class="titulo">Préstamos</h1>
<div class="tabla" >
    <table class="tRoles table table-striped table-hover">
        <tr>
            <th>Ejemplar</th>
            <th>Autor(es)</th>
            <th>Préstamo</th>
            <th>Vencimiento</th>
        </tr>
        @foreach($prestamos as $prestamo)
        <tr>
            <td>{{ $prestamo->ejemplar }}</td>
            <td>{{ $prestamo->autor }}</td>
            <td>{{ $prestamo->prestamo }}</td>
            <td>{{ $prestamo->vencimiento }}</td>
        </tr>
        @endforeach
    </table>
</div>

@endsection
