@extends('layouts.index')

<title>@yield('title') Asignar Proyectos</title>
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

                    <h2 class="font-weight-bold text-dark">Asignar Planificación</h2>
                </div>

                <form method="post" action="{{ route('asignacion.store') }}" enctype="multipart/form-data" onsubmit="return Asignaciones(this)">
                    @csrf

                        <div class="card-body">
                            
                            <input type="hidden" class="form-control" id="id_evaluacion" name="id_evaluacion" style="background: white;" value="{{ isset($evaluacion->id)?$evaluacion->id:'' }}" placeholder="" autocomplete="off">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Vocero Asignada</label>
                                    <select class="form-select" id="id_vocero" name="id_vocero">
                                        <option value="">Seleccione un vocero</option>
                                        @foreach($voceros as $vocero)
                                            @if($vocero->tipo_vocero === 'consejo_comunal')
                                                <option value="{{ $vocero->id }}"> {{ $vocero->cedula }} {{ $vocero->nombre }} {{ $vocero->apellido }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Comunidad Asignado</label>
                                    <select class="form-select" id="id_comunidad" name="id_comunidad">
                                        <option value="">Seleccione una comunidad </option>
                                        @foreach($comunidades as $comunidad)
                                            <option value="{{ $comunidad->id }}">{{ $comunidad->nom_comuni }}</option>
                                        @endforeach
                                    </select>                                   
                                </div>

                                 <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Tipo de Ayuda Asignado</label>
                                    <select class="form-select" id="id_ayuda" name="id_ayuda">
                                        <option value="">Seleccione una ayuda </option>
                                        @foreach($ayudas as $ayuda)
                                            <option value="{{ $ayuda->id }}">{{ $ayuda->nombre_ayuda }} - {{ $ayuda->tipo_ayuda }}</option>
                                        @endforeach
                                    </select>                                   
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold text-dark">Memoria Fotográfica</label>
                                    <input type="file" id="imagenes" name="imagenes[]" multiple class="btn btn-outline-info d-block w-100">
                                    <div id="imagenes_container" class="mt-2"></div>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Descripción del Alcance</label>
                                    <textarea class="form-control" id="descri_alcance" name="descri_alcance" placeholder="Ingrese la Descripción del Alcance" oninput="capitalizarTextoarea('descri_alcance')" cols="10" rows="10" style="max-height: 6rem;"></textarea>
                                </div>
    
                                <div class="col-2">
                                    <label class="font-weight-bold text-dark">Moneda</label>
                                    <select class="form-control" id="moneda_presu" name="moneda_presu">
                                        <option value="VES">VES Bs</option>
                                        <option value="USD">USD $</option>
                                        <option value="EUR">EUR €</option>
                                    </select>
                                </div>
    
                            <div class="col-3">
                                <label class="font-weight-bold text-dark">Presupuesto</label>
                                <input type="number"  class="form-control"  id="presupuesto" name="presupuesto" style="background: white;" value="" placeholder="Ingrese el Presupuesto (solo números)" autocomplete="off"step="any" min="0"> </div>
                              </div>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Latitud de Proyecto</label>
                                    <input type="text" class="form-control" id="latitud" name="latitud" style="background: white;" value="" placeholder="Ingrese la Lalitud de proyecto" oninput="capitalizarInput('nombre_pro')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>
                                
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Longitud de Proyecto</label>
                                    <input type="text" class="form-control" id="longitud" name="longitud" style="background: white;" value="" placeholder="Ingrese la Longitud de proyecto" autocomplete="off" oninput="capitalizarInput('descripcion_pro')" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Dirección / Lugar</label>
                                    <textarea class="form-control" id="direccion" name="direccion" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ old('direccion') }}</textarea>
                                </div>

                                <div class="col-4">
                                    <div id="mapa" style="height: 350px; width:200%; display:block;"></div>
                                </div> 
                                
                            </div>

                        </div>

                        <div class="card-body">

                            <div class="row">
    
                                <div class="col-2">
                                    <label class="font-weight-bold text-dark">Impacto Ambiental</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="impacto_ambiental" id="impacto_ambiental" value="SI" onchange=")">
                                            <label class="form-check-label" for="impacto_ambiental">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="impacto_ambiental" id="impacto_ambiental" value="NO" onchange=")">
                                            <label class="form-check-label" for="impacto_ambiental">NO</label>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-2">
                                    <label class="font-weight-bold text-dark">Impacto Social</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="impacto_social" id="impacto_social" value="SI" onchange="">
                                            <label class="form-check-label" for="impacto_social">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="impacto_social" id="impacto_social" value="NO" onchange="">
                                            <label class="form-check-label" for="impacto_social">NO</label>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Fecha de Inicio</label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo date('Y-m-d'); ?>">
                                </div>
    
                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Duración Estimada</label>
                                    <input type="date" class="form-control" id="duracion_estimada" name="duracion_estimada" value="<?php echo date('Y-m-d'); ?>">
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

    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js')}}"></script>


    {{-- * FUNCION PARA MOSTRAR LAS IMAGENES --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#imagenes').change(function () {
                const fotoContainer = document.getElementById('imagenes_container');
    
                for (const file of this.files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '50%';
                        img.style.maxHeight = '50%';
                        fotoContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

    <script>
$(document).ready(function() {
    // 1. Captura los elementos del DOM
    const $selectMoneda = $('#moneda_presu');
    const $inputPresupuesto = $('#presupuesto');

    // 2. Función para actualizar el placeholder
    function actualizarPlaceholder() {
        // Obtiene el valor seleccionado (VES, USD, o EUR)
        const monedaSeleccionada = $selectMoneda.val(); 
        let simbolo = '';

        // Asigna el símbolo correcto
        switch (monedaSeleccionada) {
            case 'VES':
                simbolo = 'Bs.';
                break;
            case 'USD':
                simbolo = '$';
                break;
            case 'EUR':
                simbolo = '€';
                break;
            default:
                simbolo = ''; // Caso por defecto
        }

        // Actualiza el texto del placeholder
        $inputPresupuesto.attr('placeholder', `Ingrese el Presupuesto (${simbolo})`);
        
        // OPCIONAL: Puedes anteponer el símbolo al texto del input si ya tiene un valor
        // $inputPresupuesto.val(simbolo + ' ' + $inputPresupuesto.val().replace(/[^0-9.]/g, ''));
    }

    // 3. Llama a la función cuando cambia el select
    $selectMoneda.on('change', actualizarPlaceholder);

    // 4. Llama a la función al cargar la página para establecer el valor inicial (VES por defecto)
    actualizarPlaceholder();
});
</script>


    {{-- ? FUNCION PARA CAPITALIZAR PRIMERA LETRA --}}

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </script>

    {{-- * FUNCION PARA EL MAPA Y PARA CAPTURAR LOS DATOS DE LA LATITUD Y LONGITUD --}}

    <script>

        // Inicializa el mapa en el contenedor con ID "map"
        const map = L.map('mapa').setView([10.2825,-68.7222], 9.6); // Latitud y longitud iniciales de Yaracuy
      
        // Agrega el mapa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
      
        // Declara una variable para el marcador
        let marcador;
      
        // Agrega un marcador cuando se hace clic en el mapa
        map.on('click', (e) => {
          const latitud = e.latlng.lat;
          const longitud = e.latlng.lng;
      
          // Utiliza la API Nominatim para obtener la dirección
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitud}&lon=${longitud}&format=json&addressdetails=1&language=es`)
            .then(response => response.json())
            .then(data => {
                let estado = data.address.state;
                if (estado.includes('State')) {
                    estado = estado.replace(' State', '');
                } 
                 
              const direccion = data.address.road + ", " + data.address.postcode + ", " + data.address.county + ", " + estado + ", " + data.address.country;
      
              // Elimina cualquier marcador existente
              if (marcador) {
                map.removeLayer(marcador);
              }
      
              // Crea un marcador en la posición del clic
              marcador = L.marker([latitud, longitud], { title: direccion }).addTo(map);
      
              // Actualiza los campos de texto con las coordenadas y la dirección
              document.getElementById('latitud').value = latitud;
              document.getElementById('longitud').value = longitud;
              document.getElementById('direccion').value = direccion;
            });
        });
      
    </script>
    
    {{-- ! FUNCION PARA MOSTRAR ERRORES --}}

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