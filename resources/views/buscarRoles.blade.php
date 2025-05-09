@extends('base')
@section('titulo', 'Buscar rol')
@section('contenido')
<div class="tabla" >
    <div class="card mt-5">
        <div class="card-header">
          Rol
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$rol->tipo}}</h5>
            <p class="card-text" id="{{$rol->id}}">Id: {{$rol->id}}</p>
            <p class="card-text" id="descripcion"></p>
            <a href="{{route('roles')}}" class="btn btn-primary">
                <i class="fa-solid fa-left-long"></i> Volver
            </a>
        </div>
      </div>
</div>
<script>
    window.addEventListener("load", function() {
    var id_rol = document.getElementById("{{ $rol->id }}").id;
    var descripcion = document.getElementById("descripcion");

    switch (id_rol) {
        case '1':
            descripcion.innerHTML = "El administrador puede acceder a todas las páginas de la web y modificar todos los datos. Cuenta con todos los permisos.";
            break;
        case '2':
            descripcion.innerHTML = "El bibliotecario puede acceder al catálogo, editarlo, modificarlo y eliminar ejemplares y puede hacer lo mismo con los préstamos";
            break;
        case '3':
            descripcion.innerHTML = "El Estudiante puede acceder al catálogo y a sus préstamos";
            break;
        case '4':
            descripcion.innerHTML = "El Investigador puede acceder al catálogo y a sus préstamos";
            break;
        default:
            break;
    }
});
</script>

@endsection
