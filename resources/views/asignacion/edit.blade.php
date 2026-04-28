@extends('layouts.index')

<title>@yield('title') Asignar Equipo</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Asignar Equipo</h2>
                </div>

                <form method="post" action="{{ route('asignacion.store') }}" enctype="multipart/form-data" onsubmit="return Asignaciones(this)">
                    @csrf

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Persona Asignada</label>
                                    <select class="form-select" id="id_persona" name="id_persona">
                                        <option value="">Seleccione un persona</option>
                                        @foreach($personas as $persona)
                                            {{-- @if($persona->tipo_persona === 'consejo_comunal') --}}
                                                <option value="{{ $persona->id }}"> {{ $persona->cedula }} {{ $persona->nombre }}
                                                    {{ $persona->apellido }} -- {{ $persona->oficina->nombre_oficina }}</option>
                                            {{-- @endif --}}
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Mobiliario Asignado</label>
                                    <select class="form-select" id="id_mobiliario" name="id_mobiliario">
                                        <option value="">Seleccione un mobiliario</option>
                                        @foreach($mobiliarios as $mobiliario)
                                            <option value="{{ $mobiliario->id }}"> {{ $mobiliario->tipo }} {{ $mobiliario->serial }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Periferico Asignado</label>
                                    <select class="form-select" id="id_periferico" name="id_periferico">
                                        <option value="">Seleccione un periferico</option>
                                        @foreach($perifericos as $periferico)
                                            <option value="{{ $periferico->id }}"> {{ $periferico->tipo }} {{ $periferico->marca->nombre_marca }}
                                                {{ $periferico->modelo->nombre_modelo }} -- {{ $periferico->serial }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Fecha de Asignación</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>">
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
