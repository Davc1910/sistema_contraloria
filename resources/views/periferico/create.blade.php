@extends('layouts.index')

<title>@yield('title') Registrar Periferico</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Periférico</h2>


                </div>

                <form method="post" action="{{ route('periferico.store') }}" enctype="multipart/form-data" onsubmit="return Periferico(this)">
                    @csrf

                    <div class="card-body">

                        <div class="row">
                            
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Tipo de Periférico</label>
                                <select class="form-select" id="id_tipo" name="id_tipo">
                                    <option value="">Seleccione un Tipo</option>
                                    @foreach($tipo_perifericos as $tipo_periferico)
                                        <option value="{{ $tipo_periferico->id }}"> {{ $tipo_periferico->tipo }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Marca</label>
                                <select class="form-select" id="id_marca" name="id_marca">
                                    <option value="">Seleccione una Marca</option>
                                    @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}"> {{ $marca->nombre_marca }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Modelo</label>
                                <select class="form-select" id="id_modelo" name="id_modelo">
                                    <option value="">Seleccione un Modelo</option>
                                    @foreach($modelos as $modelo)
                                        <option value="{{ $modelo->id }}"> {{ $modelo->nombre_modelo }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Serial</label>
                                <input type="text" class="form-control" id="serial" name="serial" style="background: white;" value="" placeholder="Ingrese el serial del mobiliario" autocomplete="off">
                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('periferico/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                        </center>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </script>

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Periféricos',
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
