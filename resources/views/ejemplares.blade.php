@extends('base')
@section('titulo', 'Catálogo')
@section('contenido')
{{-- <h1 class="titulo">Catálogo</h1> --}}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4 shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Catálogo</h4>
                    @if(auth()->user())
                    @if(!auth()->user()->hasRole('Estudiante') && !auth()->user()->hasRole('Investigador'))
                    <button type="button" id="btn-crear-ejemplar" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-database-add"></i>+ Crear
                    </button>
                    @endif
                    @endif
                </div>
                <div class="card-body">
                    <table id="tablaEjemplares" class="interactuable table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Título
                                </th>
                                <th>
                                    Autor
                                </th>
                                <th>
                                    Tipo
                                </th>
                                <th>
                                    Idioma
                                </th>
                                <th>
                                    Editorial
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
<div class="modal fade" id="ejemplarEditModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar ejemplar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="ejemplar-edit-form" method="POST" action="#">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="row">
                        <div class="col-lg">
                            <label>Título</label>
                            <input type="text" id="edit-titulo" name="titulo" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Autor</label>
                            <input type="text" id="edit-autor" name="autor" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Tipo</label>
                            <select name="tipo" id="edit-tipo" class="form-control">
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->value }}">{{ $tipo->name }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" id="edit-tipo" name="tipo" class="form-control"> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Idioma</label>
                            <input type="text" id="edit-idioma" name="idioma" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Editorial</label>
                            <input type="text" id="edit-editorial" name="editorial" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" form="ejemplar-edit-form">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal para crear -->
<div class="modal fade" id="ejemplarAddModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Crear ejemplar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="ejemplar-add-form" method="POST" action="#">
                    <div class="row">
                        <div class="col-lg">
                            <label>Título</label>
                            <input type="text" id="add-titulo" name="titulo" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Autor</label>
                            <input type="text" id="add-autor" name="autor" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Tipo</label>
                            <select name="tipo" id="add-tipo" class="form-control">
                                @foreach($tipos as $tipo)
                                <option value="{{ $tipo->value }}">{{ $tipo->name }}</option>
                            @endforeach
                            </select>
                            {{-- <input type="text" id="add-tipo" name="tipo" class="form-control"> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Idioma</label>
                            <input type="text" id="add-idioma" name="idioma" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Editorial</label>
                            <input type="text" id="add-editorial" name="editorial" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" form="ejemplar-add-form">Guardar</button>
            </div>
        </div>
    </div>
</div>
@endif
@endif

<script>
    $(document).ready(function () {
        var tabla = new DataTable('#tablaEjemplares', {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json',
            },
            "ajax": {
                "url": "{{ route('ejemplaresListar') }}",
                "type": "GET",
                "dataType": "json",
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "dataSrc": function (response) {
                    if(response.status === 200) {
                        return response.ejemplares;
                    }else{
                        return [];
                    }
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "titulo"},
                {"data": "autor"},
                {"data": "tipo"},
                {"data": "idioma"},
                {"data": "editorial"},
                @if(auth()->user())
                @if(!auth()->user()->hasRole('Estudiante') && !auth()->user()->hasRole('Investigador'))
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="#" class="btn btn-sm btn-warning edit-btn" data-id="'+data.id+'" data-titulo="'+data.titulo+'" data-autor="'+data.autor+'" data-tipo="'+data.tipo+'" data-idioma="'+data.idioma+'" data-editorial="'+data.editorial+'">Editar</a> ' +
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
        $("#tablaEjemplares tbody").on('click', 'tr', function(){
            var id = $(this).data('id'); //Obtener el ID de la fila pulsada
            if(id) {
                window.location.href = '{{ route("buscarEjemplar", ":id") }}'.replace(':id', id);
            }
        });
        $('#btn-crear-ejemplar').click(function () {
                $('#ejemplarAddModal').modal('show');
        });

        $('#ejemplar-add-form').submit(function (e) {
            e.preventDefault();
            const ejemplar = new FormData(this);
            var paginaActual = tabla.page();

            $.ajax({
                url: '{{ route("crearEjemplares") }}',
                method: 'POST',
                data: ejemplar,
                processData: false,  // Importante, ya que estamos usando FormData
                contentType: false,  // Asegúrate de que no se manipule el tipo de contenido
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 200) {
                        $('#ejemplar-add-form')[0].reset();
                        $('#ejemplarAddModal').modal('hide');

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
            $('#tablaEjemplares tbody').on('click', '.edit-btn', function (event) {
                event.stopPropagation();
                var id = $(this).data('id');
                var titulo = $(this).data('titulo');
                var autor = $(this).data('autor');
                var tipo = $(this).data('tipo');
                var idioma = $(this).data('idioma');
                var editorial = $(this).data('editorial');
            
                $('#edit-id').val(id);
                $('#edit-titulo').val(titulo);
                $('#edit-autor').val(autor);
                $('#edit-tipo').val(tipo);
                $('#edit-idioma').val(idioma);
                $('#edit-editorial').val(editorial);

                $('#ejemplarEditModal').modal('show');
            });

            $('#ejemplar-edit-form').submit(function (e) {
                if (confirm('¿Estás seguro de que desea editar este ejemplar?')) {
                    e.preventDefault();
                    const ejemplar = new FormData(this);
                    var paginaActual = tabla.page();

                    $.ajax({
                        url: '{{ route("mostrarEditarEjemplares", ":id") }}'.replace(':id', ejemplar.get("id")),
                        method: 'POST',
                        data: ejemplar,
                        processData: false,  // Importante, ya que estamos usando FormData
                        contentType: false,  // Asegúrate de que no se manipule el tipo de contenido
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 200) {
                                $('#ejemplar-edit-form')[0].reset();
                                $('#ejemplarEditModal').modal('hide');

                                var row = tabla.row(function(idx, data, node) {
                                    return data.id === response.ejemplar.id; // Asegúrate de que "id" es el nombre correcto
                                });

                                row.data({
                                    "id": response.ejemplar.id,
                                    "titulo": response.ejemplar.titulo,
                                    "autor": response.ejemplar.autor,
                                    "tipo": response.ejemplar.tipo,
                                    "idioma": response.ejemplar.idioma,
                                    "editorial": response.ejemplar.editorial,
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

            $('#tablaEjemplares tbody').on('click', '.delete-btn', function(event) {
                event.stopPropagation();
                var id = $(this).data('id');
                var row = $(this).closest('tr');

                if (confirm('¿Estás seguro de que desea eliminar este ejemplar?')) {
                    $.ajax({
                        url: '{{ route("eliminarEjemplares", ":id") }}'.replace(':id', id),
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
