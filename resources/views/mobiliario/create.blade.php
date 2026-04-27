@extends('layouts.index')

<title>@yield('title') Registrar Mobiliario</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Mobiliario</h2>

                </div>

                    <form method="post" action="{{ route('mobiliario.store') }}" enctype="multipart/form-data" onsubmit="return Mobiliario(this)">
                        @csrf

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Tipo de Mobiliario</label>
                                    <input type="text" class="form-control" id="tipo" name="tipo" style="background: white;" value="" placeholder="Ingrese el tipo de mobiliario" autocomplete="off" oninput="capitalizarInput('tipo')">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Serial</label>
                                    <input type="text" class="form-control" id="serial" name="serial" style="background: white;" value="" placeholder="Ingrese el serial del mobiliario" autocomplete="off">
                                </div>

                            </div>

                            <br><br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('mobiliario/') }}"><span class="icon text-white-50">
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
                        title: 'mobiliario',
                        text: error,
                        icon: 'warning',
                        showConfimButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                    });
                });
        </script>
    @endif

@endsection


