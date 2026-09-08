@extends('layouts.index')

<title>@yield('title') Inventario</title>

@section('css-datatable')
    <link href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h2 class="font-weight-bold text-dark">Inventario</h2>
                    </div>

                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="inventarioTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="font-weight-bold text-dark">Código</th>
                                    <th class="font-weight-bold text-dark">Tipo</th>
                                    <th class="font-weight-bold text-dark">Detalle</th>
                                    <th class="font-weight-bold text-dark">Descripción</th>
                                    <th class="font-weight-bold text-dark">Serial</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($articulos as $articulo)
                                    <tr>
                                        <td>
                                            @if($articulo->tipo_biene === 'Mobiliario')
                                                {{ $articulo->articuloEspecifico->codigo_mobiliario ?? 'N/A' }}
                                            @elseif($articulo->tipo_biene === 'Equipo')
                                                {{ $articulo->articuloEspecifico->codigo_equipo ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                        <td>
                                            @if($articulo->tipo_biene === 'Mobiliario')
                                                <span class="badge bg-info text-dark">Mobiliario</span>
                                            @elseif($articulo->tipo_biene === 'Equipo')
                                                <span class="badge bg-success text-white">Equipo</span>
                                            @else
                                                <span class="badge bg-secondary text-white">{{ $articulo->tipo_biene }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($articulo->tipo_biene === 'Mobiliario')
                                                <strong>Tipo:</strong> {{ $articulo->articuloEspecifico->tipo_mobiliario ?? 'N/A' }}<br>
                                                <strong>Dimensiones:</strong> {{ $articulo->articuloEspecifico->altura ?? 'N/A' }} x {{ $articulo->articuloEspecifico->anchura ?? 'N/A' }}
                                            @elseif($articulo->tipo_biene === 'Equipo')
                                                <strong>CPU:</strong> {{ $articulo->articuloEspecifico->cpu ?? 'N/A' }}<br>
                                                <strong>RAM:</strong> {{ $articulo->articuloEspecifico->ram ?? 'N/A' }}<br>
                                                <strong>Disco:</strong> {{ $articulo->articuloEspecifico->disco_duro ?? 'N/A' }}
                                            @endif
                                        </td>

                                        <td>
                                            @if($articulo->tipo_biene === 'Mobiliario')
                                                {{ $articulo->articuloEspecifico->descripcion_mobiliario ?? 'Sin descripción' }}
                                            @elseif($articulo->tipo_biene === 'Equipo')
                                                {{ $articulo->articuloEspecifico->descripcion_equipo ?? 'Sin descripción' }}
                                            @endif
                                        </td>

                                        <td>
                                            {{ $articulo->articuloEspecifico->serial ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <p class="text-muted mb-0">No hay registros en el inventario.</p>
                                        </td>
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
            $('#inventarioTable').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    lengthMenu: 'Mostrar <select class="form-select"><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">Todos</option></select> registros por página',
                    infoEmpty: 'No hay registros disponibles.',
                    zeroRecords: 'Nada encontrado.',
                    info: 'Mostrando la página _PAGE_ de _PAGES_',
                    infoFiltered: '(filtrado de _MAX_ registros totales)',
                    search: 'Buscar:',
                    paginate: {
                        next: 'Siguiente',
                        previous: 'Anterior'
                    }
                }
            });
        });
    </script>
@endsection
