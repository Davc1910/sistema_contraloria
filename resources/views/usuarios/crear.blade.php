@extends('layouts.index')

<title>@yield('title') Registrar Usuarios</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Usuarios</h2>

                </div>
                

                <form method="post" action="{{ route('usuarios.store') }}" enctype="multipart/form-data" onsubmit="return usuario(this)">
                    @csrf
                        
                    <div class="card-body">
                        
                        <div class="row">

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Roles</label>
                                {!! Form::select('roles[]', $roles,[], array('class' => 'form-select', 'id' => 'roles', 'onchange' => 'mostrarCampoCedula()')) !!}
                            </div>

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" style="background: white;" value="" placeholder="Ingrese el Nombre" autocomplete="off" onkeypress="return soloLetras(event);">
                            </div>
    
                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" style="background: white;" value="" placeholder="Ingrese el E-mail" autocomplete="off">
                            </div>
    
                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" style="background: white;" value="" placeholder="Ingrese El Usuario" autocomplete="off">
                            </div>
    
                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" style="background: white;" value="" placeholder="Ingrese la Contrseña" autocomplete="off">
                            </div>
    
                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" style="background: white;" value="" placeholder="Confirme La Contraseña" autocomplete="off">
                            </div>
    
                        </div>

                    </div>

                        <br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar</span>
                            </button>
                            <a  class="btn btn-info btn-lg" href="{{ url('usuarios/') }}"><span class="icon text-white-50">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">Regresar</span></a>
                        </center>
                </form>
            </div>
        </div>    
</div>

@if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Usuario',
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