@extends('layouts.index')

<title>@yield('title')Control De Seguimientos</title>

@section('css-datatable')
        <link href="{{ asset ('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                             <a href="{{ url('controlseguimiento/pdf') }}" class="btn btn-sm btn-danger" target="_blank" id="pdfButton">
                                {{ ('ACTA') }}
                            </a>
                    <h2 class="font-weight-bold text-dark" style="margin-right: 43%;">Control De Seguimientos</h2>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th class="font-weight-bold text-dark">Responsable del Seguimiento</th>
                                <th class="font-weight-bold text-dark">Visita del Seguimiento</th>
                                <th class="font-weight-bold text-dark">Detalles del Seguimiento</th>
                                <th class="font-weight-bold text-dark">Gasto y Moneda</th>
                                <th class="font-weight-bold text-dark">Fecha y Hora de Seguimiento</th>
                                <th class="font-weight-bold text-dark">Estado</th>
                                <th class="font-weight-bold text-dark"><center>Acciones</center></th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($seguimientos as $seguimiento)
                                    <tr>
                                        <td class="font-weight-bold text-dark">{{ $seguimiento->asignacion->evaluacion->resposanbles->cedula }} - 
                                            {{ $seguimiento->asignacion->evaluacion->resposanbles->nombre }} {{ $seguimiento->asignacion->evaluacion->resposanbles->apellido }}
                                        </td>

                                        <td class="font-weight-bold text-dark">{{ $seguimiento->visita->visita }}</td>

                                        <td class="font-weight-bold text-dark">{{ $seguimiento->detalle_segui }}</td>
                                        
                                        <td class="font-weight-bold text-dark">{{ $seguimiento->gasto }} {{ $seguimiento->moneda }} </td>
                                        
                                        <td class="font-weight-bold text-dark">{{ date('d/m/Y H:i', strtotime($seguimiento->fecha_hor)) }}</td>

                                        <td>
                                            <span class="badge badge-{{ 
                                                $seguimiento->estado_actual == 'Completado' ? 'success' : 
                                                ($seguimiento->estado_actual == 'Retrasado' ? 'danger' : 
                                                ($seguimiento->estado_actual == 'En riesgo' ? 'warning' : 'info'))
                                            }}">
                                                {{ $seguimiento->estado_actual }}
                                            </span>
                                        </td>

                                        <td>
                                            @can('editar-seguimiento')
                                                <a class="btn btn-warning btn-sm" style="margin: 0 3px;" title="Desea Editar el Seguimiento" href="{{ route('seguimiento.edit', $seguimiento->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                    </svg>
                                                </a>
                                            @endcan
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