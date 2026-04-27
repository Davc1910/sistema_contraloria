@extends('layouts.index')

<title>@yield('title') Actulizar La Asignacion Del Proyectos</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
<link  href="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css')}}" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js')}}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h2 class="font-weight-bold text-dark">Actualizar proyectos</h2>
                </div>

                <form method="post" action="{{ route('asignacion.update', $asignacion->id) }}" enctype="multipart/form-data" onsubmit="return Asignaciones(this)">
                    @csrf
                    {{ method_field('PATCH') }}

                    <div class="card-body">

                        <input type="hidden" class="form-control" id="id_evaluacion" name="id_evaluacion" style="background: white;" value="{{ isset($asignacion->evaluacion->id)?$asignacion->evaluacion->id:'' }}" placeholder="" autocomplete="off">
                        
                        <div class="row">

                           <div class="col-4">
                                <label class="font-weight-bold text-dark">Vocero Asignada</label>
                                <select class="form-select" id="id_vocero" name="id_vocero">
                                    @foreach($voceros as $vocero)
                                        @if($vocero->tipo_vocero === 'consejo_comunal')
                                            <option value="{{ $vocero->id }}" @selected($vocero->id_vocero == $vocero->id)>{{ $vocero->cedula }} - {{ $vocero->nombre }} {{ $vocero->apellido }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Comunidad Asignada</label>
                                <select class="form-select" id="id_comunidad" name="id_comunidad">
                                    <option value="">Seleccione una comunidad</option>
                                    @foreach($comunidades as $comunidad)
                                        <option value="{{ $comunidad->id }}" {{ $asignacion->id_comunidad == $comunidad->id ? 'selected' : '' }}>
                                            {{ $comunidad->nom_comuni }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Tipo de Ayuda Asignado</label>
                                <select class="form-select" id="id_ayuda" name="id_ayuda">
                                   <option value="">Seleccione una ayuda</option>
                                    @foreach($ayudas as $ayuda)
                                        <option value="{{ $ayuda->id }}" {{ $asignacion->id_ayuda == $ayuda->id ? 'selected' : '' }}>
                                         {{ $ayuda->nombre_ayuda }} - {{ $ayuda->tipo_ayuda }}
                                        </option>
                                   @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-1 mt-5 mx-7">
                                <img id="miniaturas">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label  class="font-weight-bold text-primary">Reseña Fotográfica</label>
                                <input type="file" id="imagenes" name="imagenes[]" multiple value="{{ $imagenes }}" class="btn btn-outline-info d-block w-100">
                                    <div id="foto_container" style="margin-top: 3%; display: flex; flex-wrap: wrap;"></div>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Descripción del Alcance</label>
                                <textarea class="form-control" id="descri_alcance" name="descri_alcance" rows="3" placeholder="Ingrese la Descripción del Alcance" oninput="capitalizarTextoarea('descri_alcance')" cols="10" rows="10" style="max-height: 6rem;">{{ $asignacion->descri_alcance }}</textarea>
                            </div>

                             <div class="col-2">
                                <label class="font-weight-bold text-dark">Moneda</label>
                                <select class="form-control" id="moneda_presu" name="moneda_presu">
                                    <option value="VES " {{ $asignacion->moneda_presu == 'VES' ? 'selected' : '' }}>VES Bs</option>
                                    <option value="USD" {{ $asignacion->moneda_presu == 'USD' ? 'selected' : '' }}>USD $</option>
                                    <option value="EUR" {{ $asignacion->moneda_presu == 'EUR' ? 'selected' : '' }}>EUR €</option>
                                </select>
                            </div>

                            <div class="col-3">
                                <label class="font-weight-bold text-dark">Presupuesto</label>
                                <input type="number" class="form-control"id="presupuesto" name="presupuesto"style="background: white;"value="{{ $asignacion->presupuesto }}" placeholder="Ingrese el Presupuesto (solo números)"autocomplete="off"step="any" min="0">   
                            </div>


                        </div>
                    
                    </div>

                     <div class="card-body">

                        <div class="row">
    
                            <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Latitud de Proyecto</label>
                                    <input type="text" class="form-control" id="latitud" name="latitud" style="background: white;" value="{{ $asignacion->latitud }}" placeholder="Ingrese La latitud" oninput="capitalizarInput('latitud')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>
                                
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Longitud de Proyecto</label>
                                    <input type="text" class="form-control" id="longitud" name="longitud" style="background: white;" value="{{ $asignacion->longitud }}" placeholder="Ingrese La Longitud" autocomplete="off" oninput="capitalizarInput('longitud')" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Dirección / Lugar</label>
                                    <textarea class="form-control" id="direccion" name="direccion" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ $asignacion->direccion }}</textarea>
                                </div>

                            <div class="col-4">
                                <div id="mapa" style="height: 350px; width:200%;"></div>
                            </div>
                        
                        </div>
                        
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-2">
                                <label class="font-weight-bold text-dark">Impacto Ambiental</label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="impacto_ambiental" id="impacto_ambiental" value="SI" {{ ($asignacion->impacto_ambiental=="SI")? "checked" : ""}}>
                                        <label class="form-check-label" for="impacto_ambiental">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="impacto_ambiental" id="impacto_ambiental" value="NO" {{ ($asignacion->impacto_ambiental=="NO")? "checked" : ""}}>
                                        <label class="form-check-label" for="impacto_ambiental">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2">
                                <label class="font-weight-bold text-dark">Impacto Ambiental</label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="impacto_social" id="impacto_social" value="SI" {{ ($asignacion->impacto_social=="SI")? "checked" : ""}}>
                                        <label class="form-check-label" for="impacto_social">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="impacto_social" id="impacto_social" value="NO" {{ ($asignacion->impacto_social=="NO")? "checked" : ""}}>
                                        <label class="form-check-label" for="impacto_social">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ $asignacion->fecha_inicio }}">
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Duración Estimada</label>
                                <input type="text" class="form-control" id="duracion_estimada" name="duracion_estimada" style="background: white;" value="{{ $asignacion->duracion_estimada }}" placeholder="Ingrese la Duración Estimada (ej: 3 meses, 15 días)" autocomplete="off">
                            </div>

                        </div>

                    </div>

                    <div class="card-body">
                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('seguimiento/') }}">
                                <span class="icon text-white-50"><i class="fas fa-info-circle"></i></span>
                                <span class="text">Regresar</span>
                            </a>
                        </center>
                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- * FUNCION PARA MOSTRAR LA FOTO --}}
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js')}}"></script>

    
    <script>
        $(document).ready(function () {
            const fotos = JSON.parse(@json($imagenes)); // Decodifica el JSON de las fotos
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
                const imgElement = createImageElement(`{{ asset('imagenes/') }}/${foto}`);
                fotoContainer.appendChild(imgElement);
            });
    
            // Agrega nuevas fotos seleccionadas por el usuario
            $('#imagenes').change(function () {
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

    {{-- * FUNCION PARA CAPITALIZAR LA PRIMERA LETRA --}}

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </script>

 
    <script>
        function cargarMapaYMarcador() {
        // Obtener los valores de los inputs
        const latitud = parseFloat(document.getElementById('latitud').value);
        const longitud = parseFloat(document.getElementById('longitud').value);

        // Validar los datos
        if (isNaN(latitud) || isNaN(longitud)) {
            alert('Por favor, ingresa valores numéricos válidos para la latitud y longitud.');
            return;
        }

        // Crear el mapa
        const map = L.map('mapa').setView([latitud, longitud], 15); // Latitud y longitud iniciales

        // Agregar la capa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Declara una variable para el marcador
        let marcador;

        // Crear el marcador
       const marcadorActual = L.marker([latitud, longitud]).addTo(map);

            // Agregar evento click al mapa
            map.on('click', function(e) {
        // Eliminar el marcador anterior si existe
        if (marcadorActual) {
             map.removeLayer(marcadorActual);
         }

        // Elimina cualquier marcador existente
        if (marcador) {
                map.removeLayer(marcador);
              }
      
        // Obtener las coordenadas del clic
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        // Crear un nuevo marcador y almacenarlo
        marcador = L.marker([lat, lng]).addTo(map)
            .bindPopup('Nuevo marcador').openPopup();

        // Actualizar los inputs
        document.getElementById('latitud').value = lat;
        document.getElementById('longitud').value = lng;
        // document.getElementById('direccion').value = "";

        // Obtener la dirección utilizando Nominatim 
        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {
                let estado = data.address.state;
                if (estado.includes('State')) {
                    estado = estado.replace(' State', '');
                }
                const direccion_nueva = data.address.road + ", " + data.address.postcode + ", " + data.address.county + ", " + estado + ", " + data.address.country;
                document.getElementById('direccion').textContent = direccion_nueva;
            });
    });
    }
    // Llamada a la función para cargar el mapa al inicio
    cargarMapaYMarcador();

    </script>


    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Asignaciones',
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