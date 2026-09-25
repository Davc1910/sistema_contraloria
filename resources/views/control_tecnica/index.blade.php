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

@section('sweetalert')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if (session('eliminar') == 'ok')

            <script>
                Swal.fire(
                '¡Eliminado!',
                'Se Eliminó Con Éxito.',
                'success'
                )
            </script>

        @endif

            <script>

                $('.sweetalert').submit(function(e){
                    e.preventDefault();

                            Swal.fire({
                            title: '¿Estás Seguro?',
                            text: "Al Hacer Estó Se Eliminará Definitivamente!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '¡Si, Eliminar!',
                            cancelButtonText: 'Cancelar',
                            }).then((result) => {
                        if (result.isConfirmed) {

                            this.submit();
                        }
                        })
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


@endsection
