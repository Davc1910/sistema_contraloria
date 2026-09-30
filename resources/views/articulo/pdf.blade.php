<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Artículos</title>

<style>
    body{
        margin: 0;
        padding: 0;
        /* background: url(../img/portada2.png); // Elimina esto, DomPDF no lo renderizará bien */
        background-size: cover;
        font-family: sans-serif;
        font-size: 0.8rem;
    }

    .header{
        background-color: rgb(11, 54, 119);
        color: rgb(231, 227, 225);
    }

    h1{
        color: rgb(0, 0, 0);
        text-align: center;
        font-family: sans-serif;
    }

    .table{
        font-size: 18px;
        text-align: center;
        width: 100%; /* Asegura que la tabla ocupe el ancho completo */
        border-collapse: collapse; /* Elimina el espacio entre celdas */
    }

    .table th, .table td {
        border: 1px solid #ccc; /* Bordes más sutiles para la tabla */
        padding: 8px;
    }

    img {
        /* Tus estilos para imágenes, considera ajustar para el PDF */
        max-width: 100%; /* Asegura que las imágenes no desborden la celda */
        height: auto;
        display: block; /* Para que margin auto funcione para centrar si es necesario */
        margin: 0 auto; /* Centrar imágenes */
    }

    .centro{
        margin-left: 10.5%;
        width: 80%;
        height: 10%; 
        border-radius: 8%;
    } 

    .footer-image { 
        width: 76%; 
        height: auto; 
        position: absolute;
        bottom: 33px; 
        left: 19%; 
        transform: translateX(-29%);
    }
</style>

</head>
<body>
    <div class="row">
        {{-- Encabezado: Usar Base64 para asegurar que se muestre --}}
        
    </div>

    <h1>Reporte de los Artículos</h1>

    <table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.4rem;font-size:0.6rem !important">
        <thead class="header">
            <tr>
                <th>Codigo</th>
                <th>Tipo de Bienes</th>
                <th>Especificaciones Técnicas / Detalles</th>
                <th>Descripcion</th>
                <th>Fecha Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articulos as $articulo)
                <tr>
                    <td>
                        @if($articulo->tipo_biene === 'Mobiliario')
                            {{ $articulo->articuloEspecifico->codigo_mobiliario }}
                        @elseif($articulo->tipo_biene === 'Equipo')
                            {{ $articulo->articuloEspecifico->codigo_equipo }}
                        @endif
                    </td>
                    <td>
                        @if($articulo->tipo_biene === 'Mobiliario')
                            <span class="badge bg-info text-dark">
                                <i class="fas fa-chair me-1"></i> Mobiliario
                            </span>
                        @elseif($articulo->tipo_biene === 'Equipo')
                            <span class="badge bg-success text-white">
                                <i class="fas fa-laptop me-1"></i> Equipo
                            </span>
                        @else
                            <span class="badge bg-secondary text-white">
                                {{ $articulo->tipo_biene }}
                            </span>
                        @endif
                    </td>

                    <td>
                        @if($articulo->articuloEspecifico)
                            @if($articulo->tipo_biene === 'Mobiliario')
                                {{-- DETALLES ESPECÍFICOS DE MOBILIARIO --}}
                                <div class="row g-1">
                                    <div class="col-sm-6">
                                        <strong>Tipo:</strong> {{ $articulo->articuloEspecifico->tipo_mobiliario ?? 'N/A' }} <br>
                                        <strong>Serial:</strong> <code class="text-dark">{{ $articulo->articuloEspecifico->serial }}</code>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong>Dimensiones:</strong>
                                        {{ $articulo->articuloEspecifico->altura }} x {{ $articulo->articuloEspecifico->anchura }} cm
                                    </div>
                                </div>
                            @elseif($articulo->tipo_biene === 'Equipo')
                                {{-- DETALLES ESPECÍFICOS DE EQUIPO --}}
                                <div class="row g-1">
                                    <div class="col-sm-6">
                                        <strong>CPU:</strong> {{ $articulo->articuloEspecifico->cpu }} <br>
                                        <strong>RAM:</strong> {{ $articulo->articuloEspecifico->ram }} |
                                        <strong>Disco:</strong> {{ $articulo->articuloEspecifico->disco_duro }}
                                    </div>
                                    <div class="col-sm-6">
                                        <strong>S.O:</strong> {{ $articulo->articuloEspecifico->sistema_operativo }} <br>
                                        <strong>Serial:</strong> <code class="text-dark">{{ $articulo->articuloEspecifico->serial }}</code> <br>
                                        <strong>Periférico:</strong>
                                        <span class="badge bg-light text-dark border">
                                            {{ $articulo->articuloEspecifico->perifericos->tipo_periferico->tipo ?? 'Ninguno' }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                        @else
                            <span class="text-danger fw-bold">
                                <i class="fas fa-exclamation-triangle me-1"></i> Sin datos específicos registrados
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($articulo->tipo_biene === 'Mobiliario')
                            {{ $articulo->articuloEspecifico->descripcion_mobiliario }}
                        @elseif($articulo->tipo_biene === 'Equipo')
                            {{ $articulo->articuloEspecifico->descripcion_equipo }}
                        @endif
                    </td>
                    <td>
                        <small>{{ $articulo->created_at->format('d/m/Y h:i A') }}</small>
                    </td>
                </tr>
            @endforeach 
        </tbody>
    </table>
    <div class="row">
        {{-- Pie de página: Asegúrate de usar Base64 también aquí --}}
       
    </div>
</body>
</html>