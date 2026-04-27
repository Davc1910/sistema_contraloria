@extends('layouts.index')

<title>@yield('title') Registrar Tipo de Periférico</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                            <h2 class="font-weight-bold text-dark">Registrar Tipo de Periférico</h2>

                        </div>

                        <form method="post" action="{{ route('tipo_periferico.store') }}" enctype="multipart/form-data" onsubmit="return TipoPeriferico(this)">
                            @csrf

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-dark">Nombre del Tipo de Periférico</label>
                                        <input type="text" class="form-control" id="tipo" name="tipo" style="background: white;" value="" placeholder="Ingrese el nombre del tipo de periférico" autocomplete="off" oninput="capitalizarInput('tipo')" onkeypress="return soloLetras(event);">
                                    </div>

                                </div>

                                <br><br>

                                <center>
                                    <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                        <span class="text">Guardar</span>
                                    </button>
                                    <a class="btn btn-info btn-lg" href="{{ url('tipo_periferico') }}"><span class="icon text-white-50">
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

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection

