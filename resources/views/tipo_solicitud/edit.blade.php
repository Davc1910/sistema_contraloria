@extends('layouts.index')

<title>@yield('title') Editar Tipo de Solicitud</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Editar Tipo de Solicitud</h2>

                </div>

                <form method="post" action="{{ route('tipo_solicitud.update', $tipo_solicitud->id) }}" enctype="multipart/form-data" onsubmit="return Solicitudes(this)">
                    @csrf
                    @method('PUT')

                        <div class="card-body">

                            <input type="hidden" class="form-control" id="id_solicitud" name="id_solicitud" style="background: white;" value="{{ isset($tipo_solicitud->solicitud->id) ? $tipo_solicitud->solicitud->id : '' }}" placeholder="" autocomplete="off">

                            <div class="accordion" id="accordionExample" style="display: flex; justify-content: center;">
                                <div class="card" style="width: 90%; border-radius: 2.5%;">

                                        <button class="btn btn-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" style="margin-top: 0.3%;">
                                             <label class="font-weight-bold text-dark">Detalles de la Solicitud</label>
                                        </button>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="card-body">

                                            <div class="form-group">

                                                <p style="margin-left: 0.5%"><strong>Tipo de Artículo: </strong>
                                                    @if (isset($tipo_solicitud->solicitud) && $tipo_solicitud->solicitud->articulos->isNotEmpty())
                                                        {{ $tipo_solicitud->solicitud->articulos->first()->tipo_biene }}
                                                    @endif
                                                </p>
                                                <p style="margin-left: 0.5%"><strong>Articulo: </strong>
                                                    @if (isset($tipo_solicitud->solicitud) && $tipo_solicitud->solicitud->articulos->isNotEmpty())
                                                        @foreach($tipo_solicitud->solicitud->articulos as $articulo)
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
                                                @if (isset($tipo_solicitud->solicitud) && $tipo_solicitud->solicitud->persona)
                                                    {{ $tipo_solicitud->solicitud->persona->nombre }} {{ $tipo_solicitud->solicitud->persona->apellido }}
                                                @endif
                                                </p>
                                                <p style="margin-left: 0.5%"><strong>Oficina: </strong>
                                                @if (isset($tipo_solicitud->solicitud) && $tipo_solicitud->solicitud->persona && $tipo_solicitud->solicitud->persona->oficina)
                                                    {{ $tipo_solicitud->solicitud->persona->oficina->encargado_cedula }} {{ $tipo_solicitud->solicitud->persona->oficina->nombre_encargado }} / {{ $tipo_solicitud->solicitud->persona->oficina->nombre_oficina }}
                                                @endif
                                                </p>
                                                <p style="margin-left: 0.5%"><strong>Fecha de Solicitud: </strong>
                                                    @if (isset($tipo_solicitud->solicitud))
                                                        {{ $tipo_solicitud->solicitud->fecha }}
                                                    @endif
                                                </p>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                @if(auth()->user()->hasRole('Administrador'))
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-dark">Estatus Inspección</label>
                                        <select class="select2single form-control" name="estatus" id="estatus">
                                            <option value="0" selected="true" disabled>Seleccione un Estatus</option>
                                            <option value="Aprobado" {{ (old('estatus', $tipo_solicitud->estatus ?? '') === 'Aprobado') ? 'selected' : '' }}>Aprobado</option>
                                            <option value="Negado" {{ (old('estatus', $tipo_solicitud->estatus ?? '') === 'Negado') ? 'selected' : '' }}>Negado</option>
                                        </select>
                                    </div>
                                @endif

                                @if(auth()->user()->hasRole('Administrador'))
                                    <div class="card-body" id="estatus_respuesta" style="display: none;">
                                        <label class="font-weight-bold text-dark">Estatus Aprobación</label>
                                        <div class="row">
                                            <div class="custom-control custom-radio col-1 mr-2">
                                                <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_pen" value="Pendiente" {{ ($tipo_solicitud->estatus_resp=="Pendiente")? "checked" : ""}}>
                                                <label class="custom-control-label" for="estatus_resp_pen">Pendiente</label>
                                            </div>
                                            <div class="custom-control custom-radio col-1 mr-2">
                                                <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_apro" value="Aprobado" {{ ($tipo_solicitud->estatus_resp=="Aprobado")? "checked" : ""}}>
                                                <label class="custom-control-label" for="estatus_resp_apro">Aprobado</label>
                                            </div>
                                            <div class="custom-control custom-radio col-1 mr-2">
                                                <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_neg" value="Negado" {{ ($tipo_solicitud->estatus_resp=="Negado")? "checked" : ""}}>
                                                <label class="custom-control-label" for="estatus_resp_neg">Negado</label>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" name="estatus_resp" id="estatus_resp" value="Pendiente">
                                @endif

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Descripcion</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" style="background: white;" placeholder="Ingrese la descripcion de la solicitud" autocomplete="off" oninput="capitalizarInput('descripcion')">{{ old('descripcion', $tipo_solicitud->descripcion) }}</textarea>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Fecha de Asignación</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $tipo_solicitud->fecha) }}">
                                </div>

                            </div>

                        </div>


                    <div class="card-body">

                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ route('valoracion_tecnica.index') }}">
                                <span class="icon text-white-50"><i class="fas fa-info-circle"></i></span>
                                <span class="text">Regresar</span>
                            </a>
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

    {{-- * FUNCION PARA MOSTRAR/OCULTAR EL ESTATUS DE RESPUESTA Y ENVIAR EL VALUE OCULTO --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const estatusSelect = document.getElementById('estatus');
            const estatusRespuestaDiv = document.getElementById('estatus_respuesta');

            function toggleEstatusRespuesta() {
                const selectedValue = estatusSelect.value;
                if (selectedValue === 'Aprobado') {
                    estatusRespuestaDiv.style.display = 'block';
                } else {
                    estatusRespuestaDiv.style.display = 'none';
                }
            }

            // Ejecutar al cargar la página
            toggleEstatusRespuesta();

            // Ejecutar al cambiar la selección
            estatusSelect.addEventListener('change', toggleEstatusRespuesta);
        });
    </script>

    {{-- ? FUNCION PARA MANTENER LA FECHA ACTUALIZADA EN EL CALENDARIO --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dateInput = document.getElementById('fecha');
            var today = new Date().toISOString().split('T')[0]; // Formato YYYY-MM-DD

            dateInput.addEventListener('focus', function() {
                if (!dateInput.value) {
                    dateInput.value = today;
                }
            });
        });
    </script>


@endsection
