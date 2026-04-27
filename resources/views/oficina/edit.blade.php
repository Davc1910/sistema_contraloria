@extends('layouts.index')

<title>@yield('title') Actualizar Oficina</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                        <h2 class="font-weight-bold text-dark">Actualizar Oficina</h2>

                    </div>

                    <form method="post" action="{{ url('/oficina/'.$oficina->id) }}" enctype="multipart/form-data" onsubmit="return Oficina(this)">
                        @csrf
                        {{ method_field('PATCH')}}

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Nombre de la Oficina</label>
                                    <input type="text" class="form-control" id="nombre_oficina" name="nombre_oficina" style="background: white;" value="{{ $oficina->nombre_oficina }}" placeholder="Ingrese El Nombre de la Oficina" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>

                            </div>

                        </div>

                        <br><br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('oficina/') }}">
                                <span class="icon text-white-50"><i class="fas fa-info-circle"></i></span>
                                <span class="text">Regresar</span>
                            </a>
                        </center>

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
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: '¡OK!',
            });
        });
    </script>
@endif


@endsection
