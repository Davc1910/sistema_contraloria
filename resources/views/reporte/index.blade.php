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

                            <a href="{{ url('reporte/pdf') }}" class="btn btn-sm btn-danger" target="_blank" id="pdfButton">
                                {{ ('PDF') }}
                            </a>

                            <h2 class="font-weight-bold text-dark" style="margin-right: 45%">Reporte General</h2>
                        </div>
                        
                        <div class="card-body">
                        <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                                    <tr>
                                        <th class="font-weight-bold text-dark">Vocero Asignado</th>
                                        <th class="font-weight-bold text-dark">Proyecto Asigando y Tipo</th>
                                        <th class="font-weight-bold text-dark">Fecha Inicial y Final del Proyecto</th>
                                        <th class="font-weight-bold text-dark">Ayuda Asignado y Tipo</th>
                                        <th class="font-weight-bold text-dark">Estatus de la Evaluacion</th>
                                        <th class="font-weight-bold text-dark">Presupuesto y moneda de la Asignacion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resultados as $resultado)
                                        <tr>
                                            <td class="font-weight-bold text-dark">{{ $resultado->cedula}}
                                                {{ $resultado->nombre}} {{ $resultado->apellido}}
                                            </td>

                                            <td class="font-weight-bold text-dark">{{ $resultado->nombre_pro}}
                                                {{ $resultado->tipo_pro}} 
                                            </td>

                                            <td class="font-weight-bold text-dark">{{ date('d/m/Y', strtotime( $resultado->fecha_inicial)) }} {{ date('d/m/Y', strtotime($resultado->fecha_final)) }}</td>
                                            
                                            <td class="font-weight-bold text-dark">{{ $resultado->nombre_ayuda }}
                                                {{ $resultado->tipo_ayuda}} 
                                            </td>

                                            <td class="font-weight-bold text-dark">{{ $resultado->viabilidad}}
                                                {{ $resultado->estatus_resp }}  
                                            </td>

                                            <td class="font-weight-bold text-dark">{{ $resultado->presupuesto}}
                                                 {{ $resultado->moneda_presu}} 
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
    
@endsection

@section('datatable')
    <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            var table = $('#dataTable').DataTable({
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
            
             function updatePdfLink() {
                var searchTerm = table.search();
                var pdfUrl = `{{ url('reporte/pdf') }}?search=${encodeURIComponent(searchTerm)}`;
                $('#pdfButton').attr('href', pdfUrl);
                console.log('PDF URL actualizada:', pdfUrl);
            }

            table.on('search.dt', function() {
                updatePdfLink();
            });

            updatePdfLink();
        });
    </script>
@endsection
