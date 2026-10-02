@extends('layouts.index')

<title>@yield('title') Reporte General</title>

@section('css-datatable')
        <link href="{{ asset ('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection


@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('reporte') }}" class="btn btn-sm btn-danger" target="_blank">PDF</a>
                            <h2 class="font-weight-bold text-dark">Reporte General</h2>
                            <span></span>

                        </div>

                    <div class="card-body">
                        <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                                    <tr>
                                        <th class="font-weight-bold text-dark">Persona</th>
                                        <th class="font-weight-bold text-dark">Solicitud</th>
                                        <th class="font-weight-bold text-dark">Fecha</th>
                                        <th class="font-weight-bold text-dark">Estatus del tipo</th>
                                        <th class="font-weight-bold text-dark">Estatus de aprobación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($solicitudes as $solicitud)
                                        <tr>
                                            <td>{{ $solicitud->persona ? $solicitud->persona->cedula . ' - ' . $solicitud->persona->nombre . ' ' . $solicitud->persona->apellido : 'N/A' }}</td>
                                            <td>{{ $solicitud->descripcion }}</td>
                                            <td>{{ date('d/m/Y', strtotime($solicitud->fecha)) }}</td>
                                            <td>{{ $solicitud->tipoSolicitud->estatus ?? 'Pendiente' }}</td>
                                            <td>{{ $solicitud->tipoSolicitud->estatus_resp ?? 'Pendiente' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No hay solicitudes registradas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                    "lengthMenu": "Mostrar " +
                                    `<select class='form-select'>
                                        <option value='5'>5</option>
                                        <option value='10'>10</option>
                                        <option value='15'>15</option>
                                        <option value='25'>25</option>
                                        <option value='50'>50</option>
                                        <option value='100'>100</option>
                                        <option value='-1'>Todos</option>
                                    </select>` +
                                    " Registros Por Página",
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
