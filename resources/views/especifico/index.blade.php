@extends('layouts.index')

<title>@yield('title') Reporte Especifico</title>

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

                            <a href="{{ url('especifico/pdf') }}" class="btn btn-sm btn-danger" target="_blank" id="pdfButton">
                                {{ ('PDF') }}
                            </a>

                            <h2 class="font-weight-bold text-dark" style="margin-right: 45%">Reporte Especifico</h2>
                        </div>
                        
                        <div class="card-body">
                        <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                                    <tr>
                                        <th class="font-weight-bold text-dark">Responsable del Seguimiento</th>
                                        <th class="font-weight-bold text-dark">Proyecto Asigando y Tipo</th>
                                        <th class="font-weight-bold text-dark">Dirección / Lugar</th>
                                        <th class="font-weight-bold text-dark">Impacto Ambiental Y Social</th>
                                        <th class="font-weight-bold text-dark">Estado Actual /Cantidad de Beneficiados</th>
                                        <th class="font-weight-bold text-dark">Gasto y moneda </th>
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
                                            
                                            <td class="font-weight-bold text-dark">{{ $resultado->direccion }} 
                                            </td>

                                            <td class="font-weight-bold text-dark">{{ $resultado->impacto_ambiental}}
                                                {{ $resultado->impacto_social }} 
                                            </td>

                                            
                                                <td>
                                            <span class="badge badge-{{ 
                                                $resultado->estado_actual == 'Completado' ? 'success' : 
                                                ($resultado->estado_actual == 'Retrasado' ? 'danger' : 
                                                ($resultado->estado_actual == 'En riesgo' ? 'warning' : 'info'))
                                            }}">
                                                {{ $resultado->estado_actual }}  
                                            </span>
                                            {{ $resultado->cantidad_bene}}
                                        </td>
                                                
                                            <td class="font-weight-bold text-dark">{{ $resultado->gasto}}
                                                 {{ $resultado->moneda}} 
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
                var pdfUrl = `{{ url('especifico/pdf') }}?search=${encodeURIComponent(searchTerm)}`;
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
