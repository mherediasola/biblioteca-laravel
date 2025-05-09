@extends('base')
@section('titulo', 'Préstamos')
@section('contenido')
{{-- <h1 class="titulo">Catálogo</h1> --}}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4 shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Préstamos</h4>
                    @if(auth()->user())
                    @if(!auth()->user()->hasRole('Estudiante') && !auth()->user()->hasRole('Investigador'))
                    <button type="button" id="btn-crear-prestamo" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-database-add"></i>+ Crear
                    </button>
                    @endif
                    @endif
                </div>
                <div class="card-body">
                    <table id="tablaPrestamos" class="interactuable table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Usuario
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Ejemplar
                                </th>
                                <th>
                                    Autor
                                </th>
                                <th>
                                    Préstamo
                                </th>
                                <th>
                                    Vencimiento
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
<div class="modal fade" id="prestamoEditModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar préstamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="prestamo-edit-form" method="POST" action="#">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="row">
                        <div class="col-lg">
                            <label for="usuario">Usuario</label>
                            <select name="usuario" id="edit-usuario" class="form-select">
                                @foreach($usuarios as $usuario)
                                <option value="{{$usuario->id}}">{{$usuario->nombre}} {{$usuario->apellidos}}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" id="edit-usuario" name="usuario" class="form-control"> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="ejemplar">Ejemplar</label>
                            <select name="ejemplar" id="edit-ejemplar" class="form-select">
                                @foreach($ejemplares as $ejemplar)
                                <option value="{{$ejemplar->id}}">{{$ejemplar->titulo}}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" id="edit-ejemplar" name="ejemplar" class="form-control"> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="prestamo">Préstamo</label>
                            <input type="date" id="edit-prestamo" name="prestamo" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="vencimiento">Vencimiento</label>
                            <input type="date" id="edit-vencimiento" name="vencimiento" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" form="prestamo-edit-form">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal para crear -->
<div class="modal fade" id="prestamoAddModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Crear préstamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="prestamo-add-form" method="POST" action="#">
                    <div class="row">
                        <div class="col-lg">
                            <label for="usuario">Usuario</label>
                            <select name="usuario" id="add-usuario" class="form-select">
                                @foreach($usuarios as $usuario)
                                <option value="{{$usuario->id}}">{{$usuario->nombre}} {{$usuario->apellidos}}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" id="add-usuario" name="usuario" class="form-control"> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="ejemplar">Ejemplar</label>
                            <select name="ejemplar" id="add-ejemplar" class="form-select">
                                @foreach($ejemplares as $ejemplar)
                                <option value="{{$ejemplar->id}}">{{$ejemplar->titulo}}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" id="add-ejemplar" name="ejemplar" class="form-control"> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="prestamo">Préstamo</label>
                            <input type="date" id="add-prestamo" name="prestamo" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="vencimiento">Vencimiento</label>
                            <input type="date" id="add-vencimiento" name="vencimiento" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" form="prestamo-add-form">Guardar</button>
            </div>
        </div>
    </div>
</div>
@endif
@endif

<script>
    $(document).ready(function () {
        var tabla = new DataTable('#tablaPrestamos', {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json',
            },
            "ajax": {
                "url": "{{ route('prestamosListar') }}",
                "type": "GET",
                "dataType": "json",
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "dataSrc": function (response) {
                    if(response.status === 200) {
                        return response.prestamos;
                    }else{
                        return [];
                    }
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "usuario"},
                {"data": "nombre"},
                {"data": "ejemplar"},
                {"data": "autor"},
                {"data": "prestamo"},
                {"data": "vencimiento"},
                @if(auth()->user())
                @if(!auth()->user()->hasRole('Estudiante') && !auth()->user()->hasRole('Investigador'))
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="#" class="btn btn-sm btn-warning edit-btn" data-id="'+data.id+'" data-usuario="'+data.id_usuario+'" data-ejemplar="'+data.id_ejemplar+'" data-prestamo="'+data.prestamo+'" data-vencimiento="'+data.vencimiento+'">Editar</a> ' +
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
        $("#tablaPrestamos tbody").on('click', 'tr', function(){
            var id = $(this).data('id'); //Obtener el ID de la fila pulsada
            if(id) {
                window.location.href = '{{ route("buscarPrestamo", ":id") }}'.replace(':id', id);
            }
        });

        $('#btn-crear-prestamo').click(function () {
                $('#prestamoAddModal').modal('show');
        });

        $('#prestamo-add-form').submit(function (e) {
            e.preventDefault();
            const prestamo = new FormData(this);
            var paginaActual = tabla.page();

            $.ajax({
                url: '{{ route("crearPrestamos") }}',
                method: 'POST',
                data: prestamo,
                processData: false,  // Importante, ya que estamos usando FormData
                contentType: false,  // Asegúrate de que no se manipule el tipo de contenido
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 200) {
                        $('#prestamo-add-form')[0].reset();
                        $('#prestamoAddModal').modal('hide');

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
            $('#tablaPrestamos tbody').on('click', '.edit-btn', function (event) {
                event.stopPropagation();
                var id = $(this).data('id');
                var usuario = $(this).data('usuario');
                var ejemplar = $(this).data('ejemplar');
                var prestamo = $(this).data('prestamo');
                var vencimiento = $(this).data('vencimiento');
            
                $('#edit-id').val(id);
                $('#edit-usuario').val(usuario);
                $('#edit-ejemplar').val(ejemplar);
                $('#edit-prestamo').val(prestamo);
                $('#edit-vencimiento').val(vencimiento);

                //cambiar el valor del usuario y ejemplar
                $('#edit-usuario').val(usuario).change();
                $('#edit-ejemplar').val(ejemplar).change();

                $('#prestamoEditModal').modal('show');
            });

            $('#prestamo-edit-form').submit(function (e) {
                if (confirm('¿Estás seguro de que desea editar este préstamo?')) {
                    e.preventDefault();
                    const prestamo = new FormData(this);
                    var paginaActual = tabla.page();

                    $.ajax({
                        url: '{{ route("mostrarEditarPrestamos", ":id") }}'.replace(':id', prestamo.get("id")),
                        method: 'POST',
                        data: prestamo,
                        processData: false,  // Importante, ya que estamos usando FormData
                        contentType: false,  // Asegúrate de que no se manipule el tipo de contenido
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 200) {
                                $('#prestamo-edit-form')[0].reset();
                                $('#prestamoEditModal').modal('hide');

                                var row = tabla.row(function(idx, data, node) {
                                    return data.id === response.prestamo.id; // Asegúrate de que "id" es el nombre correcto
                                });

                                row.data({
                                    "id": response.prestamo.id,
                                    "usuario": response.prestamo.usuario,
                                    "nombre": response.prestamo.nombre,
                                    "ejemplar": response.prestamo.ejemplar,
                                    "autor": response.prestamo.autor,
                                    "prestamo": response.prestamo.prestamo,
                                    "vencimiento": response.prestamo.vencimiento,
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

            $('#tablaPrestamos tbody').on('click', '.delete-btn', function(event) {
                event.stopPropagation();
                var id = $(this).data('id');
                var row = $(this).closest('tr');

                if (confirm('¿Estás seguro de que desea eliminar este préstamo?')) {
                    $.ajax({
                        url: '{{ route("eliminarPrestamos", ":id") }}'.replace(':id', id),
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
