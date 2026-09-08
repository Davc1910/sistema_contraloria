@extends('layouts.index')

<title>@yield('title') Actualizar Articulo</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .formulario {
        display: none; /* Inicialmente ocultos */
    }

    .formulario.active {
        display: block;
    }
</style>

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                        <h2 class="font-weight-bold text-dark">Actualizar Articulo</h2>

                    </div>

                   <div class="row justify-content-center my-4">
                        <!-- Opción: Mobiliario -->
                        <div class="custom-control custom-radio col-auto mx-4 py-2" style="transform: scale(1.3); transform-origin: center; cursor: pointer;">
                            <!-- Agregamos form="Mobiliario" si decides dejarlo fuera del tag <form> -->
                            <input type="radio" id="mobiliario" name="tipo_biene" value="Mobiliario" form="Mobiliario" class="custom-control-input" checked style="cursor: pointer;">
                            <label class="custom-control-label font-weight-bold text-dark" for="mobiliario" style="cursor: pointer;">Mobiliario</label>
                        </div>

                        <!-- Opción: Equipo -->
                        <div class="custom-control custom-radio col-auto mx-4 py-2" style="transform: scale(1.3); transform-origin: center; cursor: pointer;">
                            <!-- Agregamos form="Mobiliario" si decides dejarlo fuera del tag <form> -->
                            <input type="radio" id="equipo" name="tipo_biene" value="Equipo" form="Mobiliario" class="custom-control-input" style="cursor: pointer;">
                            <label class="custom-control-label font-weight-bold text-dark" for="equipo" style="cursor: pointer;">Equipo</label>
                        </div>
                    </div>

                    <form method="post" action="{{ route('articulo.update', $articulo->id) }}" enctype="multipart/form-data" onsubmit="return articulo(this)" id="Mobiliario" style="" class="formulario active">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <center><h3 class="font-weight-bold text-dark">Actualizar Mobiliario</h3></center>

                            <div class="row">

                                <input type="hidden" name="previous_url" value="{{ $articulo->tipo_biene }}">

                                <input type="hidden" id="tipo-mobiliario" name="tipo_biene" value="">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Codigo Mobiliario</label>
                                    <input type="text" class="form-control" id="codigo_mobiliario" name="codigo_mobiliario" value="{{ $codigo_mobiliario }}" oninput="capitalizarInput('')" readonly></input>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Tipo de Mobiliario </label>
                                    <input type="text" class="form-control" id="tipo_mobiliario" name="tipo_mobiliario" maxlength="15" style="background: white;" value="{{ $tipo_mobiliario }}" placeholder="Ingrese el nombre del mobiliario" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Altura de Mobiliario</label>
                                    <input type="text" class="form-control" id="altura" name="altura" style="background: white;" value="{{ $altura }}" placeholder="Ingrese la altura del mobiliario" autocomplete="off" oninput="capitalizarInput('nombre')" >
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Anchura de Mobiliario</label>
                                    <input type="text" class="form-control" id="anchura" name="anchura" style="background: white;" value="{{ $anchura }}" placeholder="Ingrese la anchura del mobiliario" autocomplete="off" oninput="capitalizarInput('apellido')">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Serial de Mobiliario</label>
                                    <input type="text" class="form-control" id="serial" name="serial" style="background: white;" value="{{ $serial }}" placeholder="Ingrese el serial del mobiliario" autocomplete="off" oninput="capitalizarInput('apellido')">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Descripcion de Mobiliario</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion_mobiliario" style="background: white;" value="" placeholder="Ingrese la descripcion del mobiliario" autocomplete="off" oninput="capitalizarInput('apellido')">{{ $descripcion_mobiliario }}</textarea>
                                </div>

                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('articulo/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>

                    <form method="post" action="{{ route('articulo.update', $articulo->id) }}" enctype="multipart/form-data" onsubmit="return articulo_equipo(this)" id="Equipo" style="" class="formulario inactive">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <center><h3 class="font-weight-bold text-dark">Actualizar Equipo</h3></center>

                            <div class="row">

                                <input type="hidden" name="previous_url" value="{{ $articulo->tipo_biene }}">

                                <input type="hidden" id="tipo-Equipo" name="tipo_biene" value="">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Codigo Equipo</label>
                                    <input type="text" class="form-control" id="codigo_equipo" name="codigo_equipo" value="{{ $codigo_equipo }}" oninput="capitalizarInput('')" readonly></input>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">CPU</label>
                                    <input type="text" class="form-control" id="cpu" name="cpu" style="background: white;" value="{{ $cpu }}" maxlength="12" placeholder="Ingrese el nombre del CPU" autocomplete="off" oninput="capitalizarInput('rif')">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Ram</label>
                                    <input type="text" class="form-control" id="ram" name="ram" style="background: white;" value="{{ $ram }}" placeholder="Ingrese la cantidad de RAM" autocomplete="off" oninput="capitalizarInput('nombre_empresa')">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Disco Duro</label>
                                    <input type="text" class="form-control" id="disco_duro" name="disco_duro" style="background: white;" value="{{ $disco_duro }}" placeholder="Ingrese la capacidad del Disco" autocomplete="off">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Sistema Operativos</label>
                                    <input type="text" class="form-control" id="sistema_operativo" name="sistema_operativo" style="background: white;" value="{{ $sistema_operativo }}" placeholder="Ingrese el Sistema Operativo" autocomplete="off">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Serial</label>
                                    <input type="text" class="form-control" id="serial" name="serial" style="background: white;" value="{{ $serial }}" placeholder="Ingrese El Serial" autocomplete="off">
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Periferico Asignado</label>
                                    <select class="form-select" id="id_periferico" name="id_periferico">
                                        <option value="">Seleccione un Periferico</option>
                                        @foreach($perifericos as $periferico)
                                            <option value="{{ $periferico->id }}" {{ $periferico->id == $id_periferico ? 'selected' : '' }}>
                                                Tipo: {{ $periferico->tipo_periferico->tipo }}/ Serial: {{ $periferico->serial }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Descripcion del Equipo</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion_equipo" style="background: white;" placeholder="Ingrese la descripcion del equipo" autocomplete="off" oninput="capitalizarInput('apellido')">{{ $descripcion_equipo }}</textarea>
                                </div>

                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('articulo/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        function showHideForms() {
            // Selecciona todos los radio buttons con el nombre "tipo"
            const radios = document.querySelectorAll('input[type="radio"][name="tipo_biene"]');

            // Selecciona todos los formularios con los ID "Natural" y "Jurídico"
            const forms = document.querySelectorAll('#Mobiliario, #Equipo');

            // Recorre todos los formularios
            forms.forEach(form => {

                // Si el ID del formulario es "Mobiliario"
                if (form.id === 'Mobiliario') {

                    // Muestra el formulario "Mobiliario"
                    form.classList.remove('inactive');
                    form.classList.add('active');

                    // Establece el valor del campo oculto "tipo" en el formulario "Mobiliario" a "Mobiliario"
                    document.querySelector(`#tipo-Mobiliario`).value = 'Mobiliario';
                } else {

                    // Oculta el formulario "Jurídico"
                    form.classList.remove('active');
                    form.classList.add('inactive');
                }
            });

            // Recorre todos los radio buttons
            radios.forEach(radio => {

                // Agrega un evento de cambio a cada radio button
                radio.addEventListener('change', (event) => {

                    // Obtiene el valor del radio button seleccionado
                    const selectedFormId = event.target.value;

                    // Recorre todos los formularios
                    forms.forEach(form => {

                        // Si el ID del formulario coincide con el valor del radio button seleccionado
                        if (form.id === selectedFormId) {

                            // Muestra el formulario correspondiente
                            form.classList.remove('inactive');
                            form.classList.add('active');

                            // Establece el valor del campo oculto "tipo" en el formulario correspondiente al valor del radio button seleccionado
                            document.querySelector(`#tipo-${selectedFormId.toLowerCase()}`).value = selectedFormId;
                        } else {

                            // Oculta el otro formulario
                            form.classList.remove('active');
                            form.classList.add('inactive');
                        }
                    });
                });
            });
        }

        // Ejecuta la función showHideForms cuando se cargue la página
        window.addEventListener('DOMContentLoaded', showHideForms);
    </script>

    <script>
        function capitalizarPrimeraLetra(texto) {
            // Si el texto está vacío, retornamos vacío
            if (!texto) return '';

            // Separamos la primera letra y el resto del texto
            const primeraLetra = texto.charAt(0).toUpperCase();
            const restoDelTexto = texto.slice(1);

            // Combinamos la primera letra en mayúscula con el resto sin modificar
            return primeraLetra + restoDelTexto;
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </script>

    @if ($errors->any())
        <script>
            var errorMessage = @json($errors->first());
            Swal.fire({
                    title: 'Articulo',
                    text: " Esta Cédula/Rif Ya Existe.",
                    icon: 'warning',
                    showconfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',

                    }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
                })
        </script>
    @endif

@endsection
