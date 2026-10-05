@extends('layouts.index')

<title>@yield('title') Control Técnica</title>

@section('css-datatable')
        <link href="{{ asset ('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                            <h2 class="font-weight-bold text-dark">Gestión de Control  Técnica</h2>

                        </div>

                <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                            <tr>
                                <th class="font-weight-bold text-dark">Estatus Desincoporado</th>
                                <th class="font-weight-bold text-dark">Descripcion de la Valoración Técnica</th>
                                <th class="font-weight-bold text-dark">Fecha de la Valoración Técnica</th>
                                <th class="font-weight-bold text-dark"><center>Acciones</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($valoracion_tecnicas as $valoracion_tecnica)
                                    <tr>
                                        <td class="font-weight-bold text-dark">{{ $valoracion_tecnica->desincorporar }}</td>
                                        <td class="font-weight-bold text-dark">{{ $valoracion_tecnica->descripcion }}</td>
                                        <td class="font-weight-bold text-dark">{{ $valoracion_tecnica->fecha }}</td>

                                        <td>

                                            <div style="display: flex; justify-content: center;">
                                                @can('editar-valoracion_tecnica')
                                                    <a class="btn btn-warning btn-sm" href="{{ route('valoracion_tecnica.edit',$valoracion_tecnica->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                    </svg></a>
                                                @endcan

                                                <!-- Botón en la tabla/vista para abrir los detalles -->
                                                <button type="button"
                                                        class="btn btn-info btn-sm btn-detalle-valoracion_tecnica"
                                                        style="margin: 0 1px;"
                                                        title="Ver Detalles"
                                                        data-valoracion_tecnica-id="{{ $valoracion_tecnica->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-window-reverse" viewBox="0 0 16 16" style="color: #ffff; cursor: pointer;">
                                                        <path d="M13 6.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
                                                        <path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12zm0 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                                    </svg>
                                                </button>

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

    <!-- Estructura del Modal -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Detalles de la Valoración Técnica</h5>
            <button type="button" class="btn-close close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- El contenido AJAX se cargará aquí -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
    </div>

@endsection

@section('datatable')

    {{-- <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            var table = $('#dataTable').DataTable({
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

            function updatePdfLink() {
                var searchTerm = table.search();
                var pdfUrl = `{{ url('resposanble/pdf') }}?search=${encodeURIComponent(searchTerm)}`;
                $('#pdfButton').attr('href', pdfUrl);
            }

            table.on('search.dt', function () {
                var searchTerm = table.search();
                $.ajax({
                    url: "{{ url('resposanble/pdf') }}",
                    method: 'GET',
                    data: { search: searchTerm },
                    success: function(response) {
                        // Aquí puedes manejar la respuesta, si necesitas hacer algo con ella
                        console.log('PDF generado con éxito');
                    },
                    error: function(xhr) {
                        console.error('Error al generar el PDF:', xhr);
                    }
                });
                updatePdfLink();
            });
            updatePdfLink();

        });
    </script>

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Resposanble',
                    text: error,
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                });
            });
        </script>
    @endif

    {{-- * FUNCIÓN PARA MOSTRAR LOS DETALLES Y LAS FOTOS DE LA VALORACIÓN TÉCNICA --}}
    <script>
        $(document).ready(function () {

            // Evento de cierre manual (funciona para ambas versiones de Bootstrap)
            $(document).on('click', '[data-bs-dismiss="modal"], [data-dismiss="modal"]', function () {
                $('#exampleModalScrollable').modal('hide');
            });

            // Petición AJAX al hacer clic en el botón de ver detalles
            $('.btn-detalle-valoracion_tecnica').on('click', function (event) {
                event.preventDefault();

                const valoracionTecnicaId = $(this).data('valoracion_tecnica-id');

                if (!valoracionTecnicaId) {
                    console.error("El ID de la valoración técnica no está definido.");
                    return;
                }

                $.ajax({
                    url: '/valoracion_tecnica/' + valoracionTecnicaId + '/detalles',
                    type: 'GET',
                    success: function (data) {
                        let valoracionTecnicaHtml = '<main><p><b>Fotos:</b></p><div style="display: flex; flex-wrap: wrap; gap: 10px;">';

                        // Determina si res_fotos necesita JSON.parse o ya es un objeto/array
                        let fotos = typeof data.res_fotos === 'string' ? JSON.parse(data.res_fotos) : data.res_fotos;

                        if (Array.isArray(fotos)) {
                            fotos.forEach(function (foto) {
                                valoracionTecnicaHtml += `<img src="/imagen/${foto}" width="60%" style="width: calc(50% - 10px); margin-bottom: 10px;">`;
                            });
                        }

                        valoracionTecnicaHtml += '</div></main>';

                        // Renderiza el contenido en el modal
                        $('#exampleModalScrollable .modal-body').html(valoracionTecnicaHtml);

                        // Abre el modal usando Bootstrap o la API de jQuery
                        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                            const modalEl = document.getElementById('exampleModalScrollable');
                            const modalObj = bootstrap.Modal.getOrCreateInstance(modalEl);
                            modalObj.show();
                        } else {
                            $('#exampleModalScrollable').modal('show');
                        }
                    },
                    error: function (error) {
                        console.error("Error al obtener los datos:", error);
                        alert("Error al cargar los recaudos. Por favor, inténtalo de nuevo.");
                    }
                });
            });

        });
    </script>


@endsection
