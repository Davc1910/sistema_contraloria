@extends('layouts.index')

<title>@yield('title') Registrar Solicitud</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Solicitud</h2>

                </div>

                <div class="row justify-content-center my-4">

                    <div class="custom-control custom-radio col-auto mx-4 py-2" style="transform: scale(1.3); transform-origin: center; cursor: pointer;">
                        <input class="form-check-input" type="radio" name="tipo_articulo" id="articulo_simple" value="simple" checked>
                        <label class="form-check-label" for="articulo_simple">Simple</label>
                    </div>

                    <div class="custom-control custom-radio col-auto mx-4 py-2" style="transform: scale(1.3); transform-origin: center; cursor: pointer;">
                        <input class="form-check-input" type="radio" name="tipo_articulo" id="articulo_compuesto" value="compuesta">
                        <label class="form-check-label" for="articulo_compuesto">Compuesta</label>
                    </div>

                </div>

                <form method="post" action="{{ route('solicitud.store') }}" enctype="multipart/form-data" onsubmit="return Solicitudes(this)">
                    @csrf

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Persona Asignada</label>
                                    <select class="form-select" id="id_persona" name="id_persona">
                                        <option value="">Seleccione un persona</option>
                                        @foreach($personas as $persona)
                                            <option value="{{ $persona->id }}"> {{ $persona->cedula }} {{ $persona->nombre }}
                                                {{ $persona->apellido }} -- {{ $persona->oficina->nombre_oficina }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Artículo Registrado</label>
                                    <div id="articulo-simple-container" class="mt-2">
                                        <label for="id_articulo" class="sr-only">Seleccione un artículo</label>
                                        <select class="form-select" id="id_articulo" name="id_articulo">
                                            <option value="">Seleccione un artículo</option>
                                            @foreach($articulos as $articulo)
                                                <option value="{{ $articulo->id }}"> {{ $articulo->tipo_biene }}
                                                    @if($articulo->articuloEspecifico)
                                                    @if($articulo->tipo_biene === 'Mobiliario')
                                                        {{-- DETALLES ESPECÍFICOS DE MOBILIARIO --}}
                                                        {{ $articulo->articuloEspecifico->tipo_mobiliario ?? 'N/A' }} {{ $articulo->articuloEspecifico->serial }}
                                                        {{ $articulo->articuloEspecifico->altura }} {{ $articulo->articuloEspecifico->anchura }}
                                                    @elseif($articulo->tipo_biene === 'Equipo')
                                                        {{-- DETALLES ESPECÍFICOS DE EQUIPO --}}
                                                        {{ $articulo->articuloEspecifico->cpu }} {{ $articulo->articuloEspecifico->ram }}
                                                        {{ $articulo->articuloEspecifico->disco_duro }} {{ $articulo->articuloEspecifico->sistema_operativo }}
                                                        {{ $articulo->articuloEspecifico->serial }} {{ $articulo->articuloEspecifico->perifericos->tipo_periferico->tipo ?? 'Ninguno' }}
                                                    @endif
                                                @else
                                                    <span class="text-muted">Detalles no disponibles</span>
                                                @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="articulo-compuesto-container" class="mt-2" style="display: none;">
                                        <label for="articulos-compuestos" class="d-block mb-1">Seleccione uno o más artículos</label>
                                        <div id="articulos-compuestos" class="border rounded p-2" style="height: 130px; overflow-y: auto; background-color: #fff;">
                                            @foreach($articulos as $articulo)
                                                <div class="form-check">
                                                    <input class="form-check-input articulo-compuesto" type="checkbox" name="articulos[]" value="{{ $articulo->id }}" id="articulo_{{ $articulo->id }}" disabled>
                                                    <label class="form-check-label" for="articulo_{{ $articulo->id }}">
                                                    @if($articulo->articuloEspecifico)
                                                        @if($articulo->tipo_biene === 'Mobiliario')
                                                            {{-- DETALLES ESPECÍFICOS DE MOBILIARIO --}}
                                                            {{ $articulo->articuloEspecifico->tipo_mobiliario ?? 'N/A' }} {{ $articulo->articuloEspecifico->serial }}
                                                            {{ $articulo->articuloEspecifico->altura }} {{ $articulo->articuloEspecifico->anchura }}
                                                        @elseif($articulo->tipo_biene === 'Equipo')
                                                            {{-- DETALLES ESPECÍFICOS DE EQUIPO --}}
                                                            {{ $articulo->articuloEspecifico->cpu }} {{ $articulo->articuloEspecifico->ram }}
                                                            {{ $articulo->articuloEspecifico->disco_duro }} {{ $articulo->articuloEspecifico->sistema_operativo }}
                                                            {{ $articulo->articuloEspecifico->serial }} {{ $articulo->articuloEspecifico->perifericos->tipo_periferico->tipo ?? 'Ninguno' }}
                                                        @endif
                                                    @else
                                                        <span class="text-muted">Detalles no disponibles</span>
                                                    @endif
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Descripcion de la Solicitud</label>
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
                            <a class="btn btn-info btn-lg" href="{{ url('/home') }}"><span class="icon text-white-50">
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
                    title: 'Solicitud',
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
        const radioSimple = document.getElementById('articulo_simple');
        const radioCompuesta = document.getElementById('articulo_compuesto');
        const simpleContainer = document.getElementById('articulo-simple-container');
        const compuestaContainer = document.getElementById('articulo-compuesto-container');
        const articuloSimple = document.getElementById('id_articulo');
        const articulosCompuestos = document.querySelectorAll('.articulo-compuesto');

        function alternarTipoArticulo() {
            const esCompuesta = radioCompuesta.checked;
            simpleContainer.style.display = esCompuesta ? 'none' : 'block';
            compuestaContainer.style.display = esCompuesta ? 'block' : 'none';
            articuloSimple.disabled = esCompuesta;
            articuloSimple.required = !esCompuesta;
            articulosCompuestos.forEach(function (articulo) {
                articulo.disabled = !esCompuesta;
            });
        }

        radioSimple.addEventListener('change', alternarTipoArticulo);
        radioCompuesta.addEventListener('change', alternarTipoArticulo);

        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </script>

@endsection
