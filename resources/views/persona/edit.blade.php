@extends('layouts.index')

<title>@yield('title') Actualizar Personas</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                        <h2 class="font-weight-bold text-dark">Actualizar Persona</h2>

                    </div>

                    <form method="post" action="{{ url('/persona/'.$persona->id) }}" enctype="multipart/form-data" onsubmit="return Persona(this)">
                        @csrf
                        {{ method_field('PATCH')}}

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Cedula</label>
                                    <input type="text" class="form-control" id="cedula" name="cedula" style="background: white;" value="{{ $persona->cedula }}" placeholder="Ingrese la Cedula" oninput="capitalizarInput('cedula')" autocomplete="off" onkeypress="return solonum(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" style="background: white;" value="{{ $persona->nombre }}" placeholder="Ingrese el Nombre" oninput="capitalizarInput('nombre')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Apellido</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" style="background: white;" value="{{ $persona->apellido }}" placeholder="Ingrese el Apellido" oninput="capitalizarInput('apellido')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Correo</label>
                                    <input type="email" class="form-control" id="email" name="email" style="background: white;" value="{{ $persona->email }}" placeholder="Ingrese el Correo" autocomplete="off">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" style="background: white;" value="{{ $persona->telefono }}" placeholder="Ingrese el Telefono" autocomplete="off" onkeypress="return solonum(event);">
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Oficina</label>
                                    <select class="form-select" id="id_oficina" name="id_oficina">
                                        <option value="">Seleccione una Oficina</option>
                                        @foreach($oficinas as $oficina)
                                            <option value="{{ $oficina->id }}" {{ $persona->id_oficina == $oficina->id ? 'selected' : '' }}> {{ $oficina->nombre_oficina }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>

                        <br><br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('persona/') }}">
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
                title: 'Proyecto',
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
