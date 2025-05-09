@extends('base')
@section('titulo', 'Buscar ejemplar')
@section('contenido')
<h1 class="titulo">Catálogo</h1>
<div class="tabla" >
    <div>
        <a href="{{route('ejemplares')}}" class="btn btn-primary mb-3">
            <i class="fa-solid fa-left-long"></i> Volver
        </a>
    </div>
    <table class="tRoles table table-striped table-hover">
        <tr>
            <th>Id</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Tipo</th>
            <th>Idioma</th>
            <th>Editorial</th>
        </tr>
        <tr>
            <td>{{$ejemplar->id}}</td>
            <td>{{$ejemplar->titulo}}</td>
            <td>{{$ejemplar->autor}}</td>
            <td>{{$ejemplar->tipo}}</td>
            <td>{{$ejemplar->idioma}}</td>
            <td>{{$ejemplar->editorial}}</td>   
        </tr>
    </table>
</div>

@endsection
