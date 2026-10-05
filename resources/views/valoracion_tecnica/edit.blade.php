@extends('layouts.index')

<title>@yield('title') Editar Valoración Técnica</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h2 class="font-weight-bold text-dark">Editar Valoración Técnica</h2>
                </div>

                <form method="post" action="{{ route('valoracion_tecnica.update', $valoracion_tecnica->id) }}" enctype="multipart/form-data" onsubmit="return Valoracion(this)">
                    @csrf
                    @method('PUT')

                        <div class="card-body">

                            <input type="hidden" class="form-control" id="id_tipo_solicitud" name="id_tipo_solicitud" style="background: white;" value="{{ $valoracion_tecnica->id_tipo_solicitud }}" autocomplete="off">

                            <div class="accordion" id="accordionExample" style="display: flex; justify-content: center;">
                                <div class="card" style="width: 90%; border-radius: 2.5%;">

                                    <button class="btn btn-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" style="margin-top: 0.3%;">
                                         <label class="font-weight-bold text-dark">Detalles de la Solicitud</label>
                                    </button>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <p style="margin-left: 0.5%"><strong>Tipo de Artículo: </strong>
                                                    @if (isset($valoracion_tecnica->tipoSolicitud->solicitud) && $valoracion_tecnica->tipoSolicitud->solicitud->articulos->isNotEmpty())
                                                        {{ $valoracion_tecnica->tipoSolicitud->solicitud->articulos->first()->tipo_biene }}
                                                    @endif
                                                </p>

                                                <p style="margin-left: 0.5%"><strong>Artículo: </strong>
                                                    @if (isset($valoracion_tecnica->tipoSolicitud->solicitud) && $valoracion_tecnica->tipoSolicitud->solicitud->articulos->isNotEmpty())
                                                        @foreach($valoracion_tecnica->tipoSolicitud->solicitud->articulos as $articulo)
                                                            @if (($articulo->tipo_biene ?? '') === "Equipo")
                                                                {{ $articulo->articuloEspecifico?->cpu ?? '' }}
                                                                {{ $articulo->articuloEspecifico?->ram ?? '' }}
                                                                {{ $articulo->articuloEspecifico?->disco_duro ?? '' }}
                                                                {{ $articulo->articuloEspecifico?->sistema_operativo ?? '' }}
                                                                {{ $articulo->articuloEspecifico?->serial ?? '' }}
                                                                {{ $articulo->articuloEspecifico?->descripcion ?? '' }}
                                                            @else
                                                                {{ $articulo->articuloEspecifico?->tipo_mobiliario ?? '' }}
                                                                {{ $articulo->articuloEspecifico?->altura ?? '' }}
                                                                {{ $articulo->articuloEspecifico?->ancho ?? '' }}
                                                                {{ $articulo->articuloEspecifico?->serial ?? '' }}
                                                                {{ $articulo->articuloEspecifico?->descripcion ?? '' }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </p>

                                                <p style="margin-left: 0.5%"><strong>Persona: </strong>
                                                @if (isset($valoracion_tecnica->tipoSolicitud->solicitud) && $valoracion_tecnica->tipoSolicitud->solicitud->persona)
                                                    {{ $valoracion_tecnica->tipoSolicitud->solicitud->persona->nombre }} {{ $valoracion_tecnica->tipoSolicitud->solicitud->persona->apellido }}
                                                @endif
                                                </p>

                                                <p style="margin-left: 0.5%"><strong>Oficina: </strong>
                                                @if (isset($valoracion_tecnica->tipoSolicitud->solicitud->persona->oficina))
                                                    {{ $valoracion_tecnica->tipoSolicitud->solicitud->persona->oficina->encargado_cedula }} {{ $valoracion_tecnica->tipoSolicitud->solicitud->persona->oficina->nombre_encargado }} / {{ $valoracion_tecnica->tipoSolicitud->solicitud->persona->oficina->nombre_oficina }}
                                                @endif
                                                </p>

                                                <p style="margin-left: 0.5%"><strong>Fecha de Solicitud: </strong>
                                                @if (isset($valoracion_tecnica->tipoSolicitud->solicitud))
                                                    {{ $valoracion_tecnica->tipoSolicitud->solicitud->fecha }}
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

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Estatus de Desincorporación</label>
                                    <select class="select2single form-control" name="desincorporar" id="desincorporar">
                                        <option value="" disabled>Seleccione una opción</option>
                                        <option value="Dañado" {{ old('desincorporar', $valoracion_tecnica->desincorporar) == 'Dañado' ? 'selected' : '' }}>Dañado</option>
                                        <option value="Reparado" {{ old('desincorporar', $valoracion_tecnica->desincorporar) == 'Reparado' ? 'selected' : '' }}>Reparado</option>
                                    </select>
                                </div>

                                <div class="grid grid-cols-1 mt-5 mx-7">
                                    <img id="miniaturas">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Reseña Fotográfica</label>
                                    <input type="file" id="res_fotos" name="res_fotos[]" multiple value="{{ $res_fotos }}" class="btn btn-outline-info">
                                        <div id="foto_container" style="margin-top: 3%; display: flex; flex-wrap: wrap;"></div>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" style="background: white;" placeholder="Ingrese la descripción de la valoración técnica" autocomplete="off" oninput="capitalizarInput('descripcion')">{{ old('descripcion', $valoracion_tecnica->descripcion) }}</textarea>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Fecha de la Valoración Técnica</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $valoracion_tecnica->fecha) }}">
                                </div>

                            </div>
                        </div>

                    <div class="card-body">
                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ route('control_tecnica') }}">
                                <span class="icon text-white-50"><i class="fas fa-info-circle"></i></span>
                                <span class="text">Regresar</span>
                            </a>
                        </center>
                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- FUNCION PARA MOSTRAR ERRORES --}}
    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Valoración Técnica',
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

    {{-- * FUNCION PARA MOSTRAR LA FOTO --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function () {
            const fotos = JSON.parse(@json($res_fotos)); // Decodifica el JSON de las fotos
            const fotoContainer = document.getElementById('foto_container');

            // Función para crear una imagen con botón de eliminación
            function createImageElement(src) {
                const div = document.createElement('div');
                div.style.position = 'relative';
                div.style.display = 'inline-block';
                div.style.margin = '5px';
                div.style.width = 'calc(50% - 10px)'; // Ajusta el ancho para dos columnas
                div.style.boxSizing = 'border-box'; // Asegura que el margen no afecte el ancho total

                const img = document.createElement('img');
                img.src = src;
                img.style.width = '100%'; // Asegura que la imagen ocupe todo el div
                img.style.height = 'auto'; // Mantiene la proporción de la imagen
                img.style.display = 'block';

                const btn = document.createElement('button');
                btn.innerText = 'X';
                // btn.classList.add('btn btn-danger btn-sm');
                btn.style.position = 'absolute';
                btn.style.top = '0';
                btn.style.right = '0';
                btn.style.backgroundColor = 'black';
                btn.style.color = 'white';
                btn.style.border = 'none';
                btn.style.borderRadius = '50%';
                btn.style.cursor = 'pointer';
                btn.style.transform = 'translate(-15%, 15%)';
                btn.style.width = '20px';  // Ancho del botón
                btn.style.height = '20px'; // Alto del botón
                btn.style.fontSize = '12px';

                btn.addEventListener('click', () => {
                    fotoContainer.removeChild(div);
                });

                div.appendChild(img);
                div.appendChild(btn);
                return div;
            }

            // Muestra las fotos registradas
            fotos.forEach(foto => {
                const imgElement = createImageElement(`{{ asset('imagen/') }}/${foto}`);
                fotoContainer.appendChild(imgElement);
            });

            // Agrega nuevas fotos seleccionadas por el usuario
            $('#res_fotos').change(function () {
                for (const file of this.files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const imgElement = createImageElement(e.target.result);
                        fotoContainer.appendChild(imgElement);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

@endsection
