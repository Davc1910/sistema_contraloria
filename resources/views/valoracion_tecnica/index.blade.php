@extends('layouts.index')

<title>@yield('title')Valoración Técnica</title>

@section('css-datatable')
    <link href="{{ asset ('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                            <h2 class="font-weight-bold text-dark"> Gestión de Valoración Técnica</h2>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush" id="dataTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="font-weight-bold text-dark">Descripción</th>
                                        <th class="font-weight-bold text-dark">Fecha de Asignación</th>
                                        <th class="font-weight-bold text-dark">Estatus Solicitud</th>
                                        <th class="font-weight-bold text-dark">Estatus Aprobación</th>
                                        <th class="font-weight-bold text-dark"><center>Acciones</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipo_solicitudes as $tipo_solicitud)
                                        {{-- 1. Se añade data-tipo_solicitud-id a la fila --}}
                                        <tr data-tipo_solicitud-id="{{ $tipo_solicitud->id }}">
                                            <td class="font-weight-bold text-dark">{{ $tipo_solicitud->descripcion }}</td>
                                            <td class="font-weight-bold text-dark">{{ date('d/m/Y', strtotime($tipo_solicitud->fecha)) }}</td>
                                            <td class="font-weight-bold text-dark">{{ $tipo_solicitud->estatus }}</td>
                                            <td class="font-weight-bold text-dark" id="estatus-{{ $tipo_solicitud->id }}">{{ $tipo_solicitud->estatus_resp }}</td>

                                            <td>
                                                <div style="display: flex; justify-content: center; align-items: center; gap: 4px;">

                                                    @can('crear-valoracion_tecnica')
                                                        @if (!$tipo_solicitud->yaValoralizada)
                                                            <a class="btn btn-success btn-sm registrar-valoracion" style="display: none;" title="Registar valoracion" href="{{ route('valoracion_tecnica.create', ['id' => $tipo_solicitud->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                                                                <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.291-1.737l2.654-2.617 2.675 2.675a1 1 0 0 1 .293.708v.07a1 1 0 0 0 .419.815L15 16l1-1-3.081-2.2a1 1 0 0 0-.815-.419h-.07a1 1 0 0 1-.708-.293l-2.675-2.675 2.617-2.654A3.003 3.003 0 0 0 16 3a3 3 0 1 0-5.291 1.737l-2.654 2.617-2.675-2.675a1 1 0 0 1-.293-.708v-.07a1 1 0 0 0-.419-.815L1 0zm10 10 4 4-2 1-3-3 1-2zm-8 4a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm10-8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zM3 1 1 3l3 3 2-1-3-4z"/>
                                                            </svg></a>

                                                            <a class="btn btn-success btn-sm aprobar-solicitud" style="margin: 0 3px; display: none;" title="Aprobar Solicitud" data-tipo_solicitud-id='{{ $tipo_solicitud->id }}'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16" style="color: #ffff; cursor: pointer; position: center;">
                                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                                                </svg>
                                                            </a>

                                                            <meta name="csrf-token" content="{{ csrf_token() }}">

                                                            <a class="btn btn-danger btn-sm negar-solicitud" style="margin: 0 1px; display: none;" title="Negar Solicitud" data-tipo_solicitud-id='{{ $tipo_solicitud->id }}'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16" style="color: #ffff; cursor: pointer; position: center;">
                                                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                                            </svg></a>
                                                        @endif
                                                    @endcan

                                                    @can('editar-tipo_solicitud')
                                                        <a class="btn btn-warning btn-sm" title="Desea Editar la tipo_solicitud" href="{{ route('tipo_solicitud.edit',$tipo_solicitud->id) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                            </svg>
                                                        </a>
                                                    @endcan

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('datatable')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {$('#dataTable').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar " + `<select class = 'form-select'>
                                            <option value = '5'>5</option>
                                            <option value = '10'>10</option>
                                            <option value = '15'>15</option>
                                            <option value = '25'>25</option>
                                            <option value = '50'>50</option>
                                            <option value = '100'>100</option>
                                            <option value = '-1'>Todos</option>
                                        </select>` + " Registros Por Página",
                    "infoEmpty": 'No Hay Registros Disponibles.',
                    "zeroRecords": 'Nada Encontrado Disculpa.',
                    "info": 'Mostrando La Página _PAGE_ de _PAGES_',
                    "infoFiltered": '(Filtrado de _MAX_ Registros Totales)',
                    "search": "Buscar: ",
                    "paginate": {
                        'next': 'Siguiente',
                        'previous': 'Anterior',
                    },
                    decimal: ',',
                    thousands: '.',
                },
            });
        });
    </script>
@endsection

@section('sweetalert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function (error) {
                Swal.fire({
                    title: 'Seguimiento',
                    text: error,
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                });
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                title: '¡Guardado Exitoso!',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 5000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        </script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

            // Función para ajustar la visibilidad de los botones
            function ajustarBotones(estatus, tipoSolicitudId) {
                const estatusActualTd = document.querySelector(`#estatus-${tipoSolicitudId}`);
                const btnRegistrarValoracion = document.querySelector(`.registrar-valoracion[href*='${tipoSolicitudId}']`);
                const btnAprobarSolicitud = document.querySelector(`.aprobar-solicitud[data-tipo_solicitud-id='${tipoSolicitudId}']`);
                const btnNegarSolicitud = document.querySelector(`.negar-solicitud[data-tipo_solicitud-id='${tipoSolicitudId}']`);

                if (estatusActualTd) {
                    estatusActualTd.textContent = estatus;
                }

                const estatusLimpio = estatus ? estatus.trim().toLowerCase() : '';

                if (estatusLimpio === "aprobado") {
                    if (btnRegistrarValoracion) btnRegistrarValoracion.style.display = "inline-block";
                    if (btnAprobarSolicitud) btnAprobarSolicitud.style.display = "none";
                    if (btnNegarSolicitud) btnNegarSolicitud.style.display = "none";
                } else if (estatusLimpio === "negado") {
                    if (btnRegistrarValoracion) btnRegistrarValoracion.style.display = "none";
                    // Si deseas permitir volver a Aprobar una solicitud Negada, cambia a "inline-block":
                    if (btnAprobarSolicitud) btnAprobarSolicitud.style.display = "none";
                    if (btnNegarSolicitud) btnNegarSolicitud.style.display = "none";
                } else {
                    // Estado "Pendiente"
                    if (btnRegistrarValoracion) btnRegistrarValoracion.style.display = "none";
                    if (btnAprobarSolicitud) btnAprobarSolicitud.style.display = "inline-block";
                    if (btnNegarSolicitud) btnNegarSolicitud.style.display = "inline-block";
                }
            }

            // Función para actualizar en base de datos
            function actualizarEstatus(estatus, tipoSolicitudId) {
                fetch(`/actualizar-estatus-tipo_solicitud/${tipoSolicitudId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ estatus_resp: estatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        ajustarBotones(estatus, tipoSolicitudId);
                    } else {
                        console.error('Error al actualizar el estatus:', data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }

            // Eventos con delegación para clics en la tabla
            document.addEventListener("click", function (event) {
                const btnAprobar = event.target.closest(".aprobar-solicitud");
                if (btnAprobar) {
                    event.preventDefault();
                    const id = btnAprobar.getAttribute('data-tipo_solicitud-id');
                    actualizarEstatus("Aprobado", id);
                }

                const btnNegar = event.target.closest(".negar-solicitud");
                if (btnNegar) {
                    event.preventDefault();
                    const id = btnNegar.getAttribute('data-tipo_solicitud-id');
                    actualizarEstatus("Negado", id);
                }
            });

            // Recorrer filas al cargar la vista
            document.querySelectorAll("tr[data-tipo_solicitud-id]").forEach(row => {
                const tipoSolicitudId = row.getAttribute('data-tipo_solicitud-id');
                const estatusTd = document.querySelector(`#estatus-${tipoSolicitudId}`);
                if (estatusTd) {
                    ajustarBotones(estatusTd.textContent.trim(), tipoSolicitudId);
                }
            });
        });
    </script>

@endsection
