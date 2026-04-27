@extends('layouts.index')

<title>@yield('title') Registrar Responsable</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Responsable</h2>

                </div>

                <form method="post" action="{{ route('resposanble.store') }}" enctype="multipart/form-data" onsubmit="return Resposanbles(this)">
                @csrf

                    <div class="card-body">

                        <div class="row">

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Cédula </label>
                                <input type="text" class="form-control" id="cedula" name="cedula" maxlength="8" style="background: white;" value="{{ old('cedula') }}" placeholder="Ingrese La Cedula" autocomplete="off" onkeypress="return solonum(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"style="background: white;" value="{{ old('nombre') }}" placeholder="Ingrese el nombre" autocomplete="off" oninput="capitalizarInput('nombre')" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" style="background: white;" value="{{ old('apellido') }}"  placeholder="Ingrese el apellido" autocomplete="off" oninput="capitalizarInput('apellido')" onkeypress="return soloLetras(event);">
                            </div>

                             <div class="col-4">
                                <label for="id_cargo" class="font-weight-bold text-dark">Cargo del Responsables</label>
                                <select class="form-select" id="id_cargo" name="id_cargo">
                                    <option value="">Seleccione un cargo</option>
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id }}">{{ $cargo->nombre_cargo }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <br><br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('resposanble/') }}">
                                <span class="icon text-white-50"><i class="fas fa-info-circle"></i></span>
                                <span class="text">Regresar</span>
                            </a>
                        </center>

                    </div>
                </form>

            </div>
        </div>
    </div>

    {{--? ESTA FUNCION ES PARA CONVERTIR LA PRIMERA LETRA EN MASYUCUSLA Y LAS DEMAS EN MINICUSLA  --}}

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </script>

    {{--* ESTE SCRIPT ES PARA MOSTRAR LOS ERRORES DE VALIDACION  --}}

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Resposanbles',
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