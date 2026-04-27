@extends('layouts.index')

<title>@yield('title') Bitacora</title>

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

                            <h2 class="font-weight-bold text-dark">Bitacora</h2>

                    </div>

                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="font-weight-bold text-dark">id</th>
                                    <th class="font-weight-bold text-dark">Tabla Afectada</th>
                                    <th class="font-weight-bold text-dark">Operación</th>
                                    <th class="font-weight-bold text-dark">Fecha</th>
                                    <th class="font-weight-bold text-dark">Usuario BD</th>
                                    <th class="font-weight-bold text-dark">Usuario</th>
                                    <th class="font-weight-bold text-dark">Datos Nuevos</th>
                                    <th class="font-weight-bold text-dark">Datos Viejos</th>
                                </tr>
                            </thead>
                            <tbody>
                                    </tr>
                                    @foreach ($bitacora as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="font-weight-bold text-dark">{{ $item-> tablaafectada}}</td>
                                            <td class="font-weight-bold text-dark">{{ $item-> operacion}}</td>
                                            <td class="font-weight-bold text-dark">{{ $item-> fecha}}</td>
                                            <td class="font-weight-bold text-dark">{{ $item-> usuario_bd}}</td>
                                            <td class="font-weight-bold text-dark">{{ $item-> usuario}}</td>
                                            <td class="font-weight-bold text-dark">{{ $item-> datos_nuevos}}</td>
                                            <td class="font-weight-bold text-dark">{{ $item-> datos_viejos}}</td>
                                        </tr>
                                    @endforeach
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>

    @endsection 

@section('datatable')

    <script src="{{ asset ('assets/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset ('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset ('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                
                responsive: true,
                autoWidth: false,
    
                "language": {       
                    "lengthMenu": "Mostrar " + 
                                    `<select class = 'form-select'>
                                        <option value = '5'>5</option>
                                        <option value = '10'>10</option>
                                        <option value = '15'>15</option>
                                        <option value = '25'>25</option>
                                        <option value = '50'>50</option>
                                        <option value = '100'>100</option>
                                        <option value = '-1'>Todos</option>
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

            // function updatePdfLink() {
            //     var searchTerm = table.search();
            //     var pdfUrl = `{{ url('ayuda/pdf') }}?search=${encodeURIComponent(searchTerm)}`;
            //     $('#pdfButton').attr('href', pdfUrl);
            // }

            // table.on('search.dt', function () {
            //     var searchTerm = table.search();
            //     $.ajax({
            //         url: '{{ url('ayuda/pdf') }}',
            //         method: 'GET',
            //         data: { search: searchTerm },
            //         success: function(response) {
            //             // Aquí puedes manejar la respuesta, si necesitas hacer algo con ella
            //             console.log('PDF generado con éxito');
            //         },
            //         error: function(xhr) {
            //             console.error('Error al generar el PDF:', xhr);
            //         }
            //     });
            //     updatePdfLink();
            // });
            // updatePdfLink();

        });
    </script>

@endsection
