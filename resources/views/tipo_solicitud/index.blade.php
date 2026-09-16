@extends('layouts.index')

<title>@yield('title')Tipo de Solicitude</title>

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

                            {{-- <a href="{{ url('incorporar/pdf') }}" class="btn btn-sm btn-danger" target="_blank" id="pdfButton">
                            {{ ('ACTA') }}
                            </a> --}}
                    <h2 class="font-weight-bold text-dark"> Gestión de Tipo de Solicitudes</h2>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th class="font-weight-bold text-dark">Persona Asignada</th>
                                <th class="font-weight-bold text-dark">Articulo Asignado</th>
                                <th class="font-weight-bold text-dark">Fecha de Asignación</th>
                                <th class="font-weight-bold text-dark">Descripción</th>
                                <th class="font-weight-bold text-dark"><center>Acciones</center></th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($solicitudes as $solicitud)
                                    <tr>
                                        <td class="font-weight-bold text-dark">{{ $solicitud->persona->cedula }} - {{ $solicitud->persona->nombre }} {{ $solicitud->persona->apellido }}</td>
                                            {{ $solicitud->persona->oficina->nombre_oficina }}
                                        </td>

                                        <td class="font-weight-bold text-dark">{{ $solicitud->articulo->tipo_biene }}</td>

                                        <td class="font-weight-bold text-dark">{{ date('d/m/Y', strtotime($solicitud->fecha)) }}</td>

                                        <td class="font-weight-bold text-dark">{{ $solicitud->descripcion }}</td>

                                         <td>

                                            <div style="display: flex; justify-content: center;">

                                                @can('crear-tipo_solicitud')
                                                    @if (!$solicitud->yaSolicitada)
                                                        <a class="btn btn-danger btn-sm" title="Planificar" href="{{ route('tipo_solicitud.create', ['id' => $solicitud->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/></svg>
                                                        </a>
                                                    @endif
                                                @endcan

                                                @can('editar-solicitud')
                                                <a class="btn btn-warning btn-sm" style="margin: 0 3px;" title="Desea Editar la Solicitud" href="{{ route('solicitud.edit',$solicitud->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                </svg></a>
                                                @endcan

                                                <a class="btn btn-info btn-sm" style="margin: 0 1px;" title="Ver Detalles" data-solicitud-id='{{ $solicitud->id }}' class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" id="#modalScroll"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-window-reverse" viewBox="0 0 16 16"  style="color: #ffff; cursor: pointer;">
                                                    <path d="M13 6.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
                                                    <path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM2 1a1 1 0 0 0-1 1v1h14V2a1 1 0 0 0-1-1zM1 4v10a1 1 0 0 0 1 1h2V4zm4 0v11h9a1 1 0 0 0 1-1V4z"/>
                                                </svg></a>
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
@endsection

@section('datatable')
    <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
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

    {{-- ! FUNCION PARA MOSTRAR ERRORES --}}

    @if ($errors->any())
        <script>
            // ... (Tu código de SweetAlert para errores)
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                title: '¡Guardado Exitoso!',
                text: '{{ session('success') }}',
                icon: 'success', // Icono de éxito
                timer: 5000, // Opcional: la alerta se cierra automáticamente después de 3 segundos
                timerProgressBar: true,
                showConfirmButton: false // No mostramos el botón si usamos timer
            });
        </script>
    @endif
    
@endsection
