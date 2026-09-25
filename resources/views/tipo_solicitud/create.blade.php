@extends('layouts.index')

<title>@yield('title') Registrar Tipo de Solicitud</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Tipo de Solicitud</h2>

                </div>

                <form method="post" action="{{ route('tipo_solicitud.store') }}" enctype="multipart/form-data" onsubmit="return Solicitudes(this)">
                    @csrf

                        <div class="card-body">

                            <input type="hidden" class="form-control" id="id_solicitud" name="id_solicitud" style="background: white;" value="{{ isset($solicitud->id)?$solicitud->id:'' }}" placeholder="" autocomplete="off">

                            <div class="accordion" id="accordionExample" style="display: flex; justify-content: center;">
                                <div class="card" style="width: 90%; border-radius: 2.5%;">

                                        <button class="btn btn-block text-center" type="button" data-bs-toggle="collapse"data-bs-target="#collapseOne" style="margin-top: 0.3%;">
                                             <label class="font-weight-bold text-dark">Detalles de la Solicitud</label>
                                        </button>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="card-body">

                                            <div class="form-group">

                                                {{-- <p style="text-align: center" class="font-weight-bold text-dark">Datos del Solicitante</p> --}}
                                                <p style="margin-left: 0.5%"><strong>Tipo de Artículo: </strong>@if ($solicitud && $solicitud->articulos->isNotEmpty()) {{ $solicitud->articulos->first()->tipo_biene }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Articulo: </strong>
                                                    @if ($solicitud && $solicitud->articulos->isNotEmpty())
                                                        @foreach($solicitud->articulos as $articulo)
                                                                @if ($articulo->tipo_biene === "Equipo")
                                                                    {{ $articulo->articuloEspecifico->cpu ?? '' }}
                                                                    {{ $articulo->articuloEspecifico->ram ?? '' }}
                                                                    {{ $articulo->articuloEspecifico->disco_duro ?? '' }}
                                                                    {{ $articulo->articuloEspecifico->sistema_operativo ?? '' }}
                                                                    {{ $articulo->articuloEspecifico->serial ?? '' }}
                                                                    {{ $articulo->articuloEspecifico->descripcion ?? '' }}
                                                                @else
                                                                    {{ $articulo->articuloEspecifico->tipo_mobiliario ?? '' }}
                                                                    {{ $articulo->articuloEspecifico->altura ?? '' }}
                                                                    {{ $articulo->articuloEspecifico->ancho ?? '' }}
                                                                    {{ $articulo->articuloEspecifico->serial ?? '' }}
                                                                    {{ $articulo->articuloEspecifico->descripcion ?? '' }}
                                                                @endif
                                                        @endforeach
                                                    @endif
                                                </p>

                                                <p style="margin-left: 0.5%"><strong>Persona: </strong>
                                                @if ($solicitud && $solicitud->persona)
                                                    {{ $solicitud->persona->nombre }} {{ $solicitud->persona->apellido }}
                                                @endif
                                                </p>
                                                <p style="margin-left: 0.5%"><strong>Oficina: </strong>
                                                @if ($solicitud && $solicitud->persona && $solicitud->persona->oficina)
                                                    {{ $solicitud->persona->oficina->encargado_cedula }} {{ $solicitud->persona->oficina->nombre_encargado }} / {{ $solicitud->persona->oficina->nombre_oficina }}
                                                @endif
                                                </p>
                                                <p style="margin-left: 0.5%"><strong>Fecha de Solicitud: </strong>@if ($solicitud) {{ $solicitud->fecha }} @endif</p>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Estatus Solicitud</label>
                                    <select class="select2single form-control" name="estatus" id="estatus">
                                        <option value="" selected="true" disabled>Seleccione un Estatus</option>
                                        <option value="Aprobado">Aprobado</option>
                                        <option value="Negado">Negado</option>
                                    </select>
                                </div>

                                @if(auth()->user()->hasRole('Administrador'))
                                <div class="card-body" id="estatus_aprob">
                                    <label class="font-weight-bold text-dark">Estatus Aprobación</label>
                                    <div class="row">
                                        <div class="custom-control custom-radio col-1 mr-2">
                                            <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_pen" value="Pendiente" checked>
                                            <label class="custom-control-label" for="estatus_resp_pen">Pendiente</label>
                                        </div>
                                        <div class="custom-control custom-radio col-1 mr-2">
                                            <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_apro" value="Aprobado">
                                            <label class="custom-control-label" for="estatus_resp_apro">Aprobado</label>
                                        </div>
                                        <div class="custom-control custom-radio col-1 mr-2">
                                            <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_neg" value="Negado">
                                            <label class="custom-control-label" for="estatus_resp_neg">Negado</label>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Descripcion</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" style="background: white;" value="" placeholder="Ingrese la descripcion de la solicitud++++++++++++++" autocomplete="off" oninput="capitalizarInput('descripcion')"></textarea>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Fecha de Asignación</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                                </div>

                            </div>

                        </div>


                    <div class="card-body">

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('/tipo_solicitud') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                        </center>

                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- ! FUNCION PARA MOSTRAR ERRORES --}}

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Tipo de Solicitud',
                    text: error,
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                });
            });
        </script>
    @endif

     <script>

        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </script>

     {{-- * FUNCION  PARA MOSTRAR EL ESTATUS APROBACION SEGUN EL ESTATUS DE LA SOLICITUD --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const estatusInspeccion = document.getElementById('estatus');
        const estatusAprobacion = document.getElementById('estatus_aprob');

        function toggleEstatusAprobacion() {
            if (estatusInspeccion.value === 'Negado') {
                estatusAprobacion.style.display = 'none';
            } else if (estatusInspeccion.value === 'Aprobado') {
                estatusAprobacion.style.display = 'block';
            } else {
                estatusAprobacion.style.display = 'block';
            }
        }

        estatusInspeccion.addEventListener('change', toggleEstatusAprobacion);

        // Ejecutar al cargar la página para establecer el estado inicial
        toggleEstatusAprobacion();
    });

    </script>

@endsection
