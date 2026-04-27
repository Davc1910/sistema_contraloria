@extends('layouts.index')

<title>@yield('title') Registrar Modelo</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                            <h2 class="font-weight-bold text-dark">Registrar Modelo</h2>

                        </div>

                        <form method="post" action="{{ route('modelo.store') }}" enctype="multipart/form-data" onsubmit="return Modelo(this)">
                            @csrf

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-dark">Nombre del Modelo</label>
                                        <input type="text" class="form-control" id="nombre_modelo" name="nombre_modelo" style="background: white;" value="" placeholder="Ingrese El nombre del modelo" autocomplete="off" oninput="capitalizarInput('nombre modelo')" onkeypress="return soloLetrasNumero(event);">
                                    </div>

                                </div>

                                <br><br>

                                </div>

                                <br><br>

                                <center>
                                    <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                    <span class="text">Guardar</span>
                                    </button>
                                    <a  class="btn btn-info btn-lg" href="{{ url('modelo/') }}"><span class="icon text-white-50">
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

@endsection

