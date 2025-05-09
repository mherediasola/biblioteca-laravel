@extends('base')
@section('titulo', 'Usuarios')
@section('contenido')
{{-- <h1 class="titulo">Catálogo</h1> --}}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4 shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Usuarios</h4>
                    @if(auth()->user())
                    @if(!auth()->user()->hasRole('Estudiante') && !auth()->user()->hasRole('Investigador'))
                    <button type="button" id="btn-crear-usuario" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-database-add"></i>+ Crear
                    </button>
                    @endif
                    @endif
                </div>
                <div class="card-body">
                    <table id="tablaUsuarios" class="interactuable table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Rol
                                </th>
                                <th>
                                    Usuario
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Apellidos
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if(auth()->user())
@if(!auth()->user()->hasRole('Estudiante') && !auth()->user()->hasRole('Investigador'))
<!-- Modal para editar -->
<div class="modal fade" id="usuarioEditModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="usuario-edit-form" method="POST" action="#">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="row">
                        <div class="col-lg">
                            <label>Rol</label>
                            <select name="rol" id="edit-rol" class="form-control">
                                @foreach($roles as $rol)
                                <option value="{{$rol->id}}">{{$rol->tipo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Usuario</label>
                            <input type="text" id="edit-user_name" name="user_name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Email</label>
                            <input type="text" id="edit-email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Contraseña</label>
                            <input type="password" id="edit-password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Nombre</label>
                            <input type="text" id="edit-nombre" name="nombre" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Apellidos</label>
                            <input type="text" id="edit-apellidos" name="apellidos" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" form="usuario-edit-form">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal para crear -->
<div class="modal fade" id="usuarioAddModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Crear usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="usuario-add-form" method="POST" action="#">
                    <div class="row">
                        <div class="col-lg">
                            <label>Rol</label>
                            <select name="rol" id="add-rol" class="form-control">
                                @foreach($roles as $rol)
                                <option value="{{$rol->id}}">{{$rol->tipo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Usuario</label>
                            <input type="text" id="add-user_name" name="user_name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Email</label>
                            <input type="text" id="add-email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Contraseña</label>
                            <input type="password" id="add-password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Nombre</label>
                            <input type="text" id="add-nombre" name="nombre" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Apellidos</label>
                            <input type="text" id="add-apellidos" name="apellidos" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" form="usuario-add-form">Guardar</button>
            </div>
        </div>
    </div>
</div>
@endif
@endif

<script>
    $(document).ready(function () {
        var tabla = new DataTable('#tablaUsuarios', {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json',
            },
            "ajax": {
                "url": "{{ route('usuariosListar') }}",
                "type": "GET",
                "dataType": "json",
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "dataSrc": function (response) {
                    if(response.status === 200) {
                        return response.usuarios;
                    }else{
                        return [];
                    }
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "tipo"},
                {"data": "user_name"},
                {"data": "email"},
                {"data": "nombre"},
                {"data": "apellidos"},
                @if(auth()->user())
                @if(!auth()->user()->hasRole('Estudiante') && !auth()->user()->hasRole('Investigador'))
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="#" class="btn btn-sm btn-warning edit-btn" data-id="'+data.id+'" data-rol="'+data.id_rol+'" data-user_name="'+data.user_name+'" data-email="'+data.email+'" data-password="'+data.password+'" data-nombre="'+data.nombre+'" data-apellidos="'+data.apellidos+'">Editar</a> ' +
                        '<a href="#" class="btn btn-sm btn-danger delete-btn" data-id="'+data.id+'">Eliminar</a>';
                    } 
                }
                @endif
                @endif
            ],
            "createdRow": function(row, data, dataIndex) {
                //Añadir atributo data-id a cada fila
                $(row).attr('data-id', data.id);
            }
    
        });

        //Asignar evento click a las filas
        $("#tablaUsuarios tbody").on('click', 'tr', function(){
            var id = $(this).data('id'); //Obtener el ID de la fila pulsada
            if(id) {
                window.location.href = '{{ route("buscarUsuario", ":id") }}'.replace(':id', id);
            }
        });

        $('#btn-crear-usuario').click(function () {
                $('#usuarioAddModal').modal('show');
        });

        $('#usuario-add-form').submit(function (e) {
            e.preventDefault();
            const usuario = new FormData(this);
            var paginaActual = tabla.page();

            $.ajax({
                url: '{{ route("crearUsuarios") }}',
                method: 'POST',
                data: usuario,
                processData: false,  // Importante, ya que estamos usando FormData
                contentType: false,  // Asegúrate de que no se manipule el tipo de contenido
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 200) {
                        $('#usuario-add-form')[0].reset();
                        $('#usuarioAddModal').modal('hide');

                        tabla.ajax.reload(function() {
                            // Después de recargar, mantener la misma página
                            tabla.page(paginaActual).draw(false);
                        });
                    }

                    alert(response.mensaje);
                },
                error: function(xhr, status, error) {
                    console.error(xhr); // Debugging: log the error
                    alert('Error: ' + error); // Show generic error message
                }
            });
        });
        @if(auth()->user())
        @if(!auth()->user()->hasRole('Estudiante') && !auth()->user()->hasRole('Investigador'))
            $('#tablaUsuarios tbody').on('click', '.edit-btn', function (event) {
                event.stopPropagation();
                var id = $(this).data('id');
                var rol = $(this).data('rol');
                var user_name = $(this).data('user_name');
                var email = $(this).data('email');
                var password = $(this).data('password');
                var nombre = $(this).data('nombre');
                var apellidos = $(this).data('apellidos');
            
                $('#edit-id').val(id);
                $('#edit-rol').val(rol);
                $('#edit-user_name').val(user_name);
                $('#edit-email').val(email);
                $('#edit-password').val(password);
                $('#edit-nombre').val(nombre);
                $('#edit-apellidos').val(apellidos);

                //cambiar el valor de rol
                $('#edit-rol').val(rol).change();

                $('#usuarioEditModal').modal('show');
            });

            $('#usuario-edit-form').submit(function (e) {
                if (confirm('¿Estás seguro de que desea editar este usuario?')) {
                    e.preventDefault();
                    const usuario = new FormData(this);
                    var paginaActual = tabla.page();

                    $.ajax({
                        url: '{{ route("mostrarEditarUsuarios", ":id") }}'.replace(':id', usuario.get("id")),
                        method: 'POST',
                        data: usuario,
                        processData: false,  // Importante, ya que estamos usando FormData
                        contentType: false,  // Asegúrate de que no se manipule el tipo de contenido
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 200) {
                                $('#usuario-edit-form')[0].reset();
                                $('#usuarioEditModal').modal('hide');

                                var row = tabla.row(function(idx, data, node) {
                                    return data.id === response.usuario.id; // Asegúrate de que "id" es el nombre correcto
                                });

                                row.data({
                                    "id": response.usuario.id,
                                    "tipo": response.usuario.tipo,
                                    "id_rol": response.usuario.id_rol,
                                    "user_name": response.usuario.user_name,
                                    "email": response.usuario.email,
                                    "password": response.usuario.password,
                                    "nombre": response.usuario.nombre,
                                    "apellidos": response.usuario.apellidos,
                                }).draw();

                                tabla.page(paginaActual).draw('page');
                            }

                            alert(response.mensaje);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr); // Debugging: log the error
                            alert('Error: ' + error); // Show generic error message
                        }
                    });
                }
            });

            $('#tablaUsuarios tbody').on('click', '.delete-btn', function(event) {
                event.stopPropagation();
                var id = $(this).data('id');
                var row = $(this).closest('tr');

                if (confirm('¿Estás seguro de que desea eliminar este usuario?')) {
                    $.ajax({
                        url: '{{ route("eliminarUsuarios", ":id") }}'.replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 200) {
                                row.remove().draw(); // Reload the table data
                            }

                            alert(response.mensaje); // Show success message
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr); // Debugging: log the error
                            alert('Error: ' + error); // Show generic error message
                        }
                    });
                }
            });
        @endif
        @endif

    });

</script>

@endsection
