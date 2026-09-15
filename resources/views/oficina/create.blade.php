@extends('layouts.index')

<title>@yield('title') Registrar Oficina</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Oficina</h2>

                </div>

                    <form method="post" action="{{ route('oficina.store') }}" enctype="multipart/form-data" onsubmit="return Oficina(this)">
                        @csrf

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Cedula de El Encargado</label>
                                    <input type="text" class="form-control" id="encargado_cedula" name="encargado_cedula" style="background: white;" value="" placeholder="Ingrese la cedula del encargado" autocomplete="off" onkeypress="return solonum(event);">
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Nombre del Encargado</label>
                                    <input type="text" class="form-control" id="nombre_encargado" name="nombre_encargado" style="background: white;" value="" placeholder="Ingrese el nombre del encargado" autocomplete="off" oninput="capitalizarInput('nombre_encargado')" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Nombre de la Oficina</label>
                                    <input type="text" class="form-control" id="nombre_oficina" name="nombre_oficina" style="background: white;" value="" placeholder="Ingrese El nombre de la oficina" autocomplete="off" oninput="capitalizarInput('nombre_oficina')" onkeypress="return soloLetras(event);">
                                </div>

                            </div>

                            <br><br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('oficina/') }}"><span class="icon text-white-50">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                    <span class="text">Regresar</span></a>
                            </center>

                        </div>

                    </form>

              </div>
            </div>
          </div>
        </div>
    </div>

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                    Swal.fire({
                        title: 'Oficina',
                        text: error,
                        icon: 'warning',
                        showConfimButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                    });
                });
        </script>
    @endif

     {{-- ? FUNCIÓN PARA CONVERTIR UNA LETRA EN MAYÚSCULAS Y LOS DEMAS EN MINÚSCULAS --}}

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </script>

@endsection


