@extends('layouts.index')

<title>@yield('title') Registrar Valoracion Tecnica</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Valoracion Tecnica</h2>

                </div>

                <form method="post" action="{{ route('valoracion_tecnica.store') }}" enctype="multipart/form-data" onsubmit="return Valoracion(this)">
                    @csrf

                        <div class="card-body">

                            <input type="hidden" class="form-control" id="id_tipo_solicitud" name="id_tipo_solicitud" style="background: white;" value="{{ isset($tipo_solicitud->id)?$tipo_solicitud->id:'' }}" placeholder="" autocomplete="off">

                            <div class="accordion" id="accordionExample" style="display: flex; justify-content: center;">
                                <div class="card" style="width: 90%; border-radius: 2.5%;">

                                        <button class="btn btn-block text-center" type="button" data-bs-toggle="collapse"data-bs-target="#collapseOne" style="margin-top: 0.3%;">
                                             <label class="font-weight-bold text-dark">Detalles de la Solicitud</label>
                                        </button>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="card-body">

                                            <div class="form-group">

                                                {{-- <p style="text-align: center" class="font-weight-bold text-dark">Datos del Solicitante</p> --}}
                                                <p style="margin-left: 0.5%"><strong>Tipo de Artículo: </strong>@if ($tipo_solicitud->solicitud && $tipo_solicitud->solicitud->articulos->isNotEmpty()) {{ $tipo_solicitud->solicitud->articulos->first()->tipo_biene }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Articulo: </strong>
                                                    @if ($tipo_solicitud->solicitud && $tipo_solicitud->solicitud->articulos->isNotEmpty())
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
                                                @if ($tipo_solicitud->solicitud && $tipo_solicitud->solicitud->persona)
                                                    {{ $tipo_solicitud->solicitud->persona->nombre }} {{ $tipo_solicitud->solicitud->persona->apellido }}
                                                @endif
                                                </p>
                                                <p style="margin-left: 0.5%"><strong>Oficina: </strong>
                                                @if ($tipo_solicitud->solicitud && $tipo_solicitud->solicitud->persona && $tipo_solicitud->solicitud->persona->oficina)
                                                    {{ $tipo_solicitud->solicitud->persona->oficina->encargado_cedula }} {{ $tipo_solicitud->solicitud->persona->oficina->nombre_encargado }} / {{ $tipo_solicitud->solicitud->persona->oficina->nombre_oficina }}
                                                @endif
                                                </p>
                                                <p style="margin-left: 0.5%"><strong>Fecha de Solicitud: </strong>@if ($tipo_solicitud->solicitud) {{ $tipo_solicitud->solicitud->fecha }} @endif</p>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Estatus de Desincorporación</label>
                                    <select class="select2single form-control" name="desincorporar" id="desincorporar">
                                        <option value="" selected="true" disabled>Seleccione un desincorporación</option>
                                        <option value="Dañado">Dañado</option>
                                        <option value="Reparado">Reparado</option>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Descripcion</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" style="background: white;" value="" placeholder="Ingrese la descripcion de la valoración tecnica" autocomplete="off" oninput="capitalizarInput('descripcion')"></textarea>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Fecha de la Valoración Tecnica</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                                </div>

                            </div>

                        </div>


                    <div class="card-body">

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('/valoracion_tecnica') }}"><span class="icon text-white-50">
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

@endsection
