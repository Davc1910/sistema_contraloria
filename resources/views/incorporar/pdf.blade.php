<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Seguimientos</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url(../img/portada2.png);
            background-size: cover;
            font-family: sans-serif;
            font-size: 0.8rem;
        }

        .header {
            background-color: rgb(11, 54, 119);
            color: rgb(231, 227, 225);
        }

        h1 {
            color: rgb(0, 0, 0);
            text-align: center;
            font-family: sans-serif;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: rgb(11, 54, 119);
            color: white;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .badge {
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }

        .badge-alta {
            background-color: #dc3545;
        }

        .badge-media {
            background-color: #ffc107;
            color: #000;
        }

        .badge-baja {
            background-color: #28a745;
        }

        .badge-completado {
            background-color: #17a2b8;
        }

        .badge-progreso {
            background-color: #007bff;
        }

        .badge-cancelado {
            background-color: #6c757d;
        }

        .badge-pendiente {
            background-color: #6c757d;
        }

        .header-image {
            width: 80%;
            margin: 0 auto 20px;
            display: block;
        }

        .footer-image {
            width: 76%;
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .page-break {
            page-break-after: always;
        }

        .text-center {
            text-align: center;
        }

        .date-info {
            text-align: right;
            font-size: 12px;
            margin-bottom: 10px;
        }
    </style>
</head>

    <body>

        <div class="row">
            <img class="header-image" src="../public/img/portada2.png" alt="Encabezado">
        </div>
        
        <div class="date-info" style="">
            Generado el: {{ now()->format('d/m/Y H:i:s') }}
        </div>
        
        <h1>Actas De Las Seguimientos</h1>
        
            <table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.4rem;front-size:0.6rem !important">
                <thead class="header">
                    <tr>
                        
                        <th>Visita Asignado</th>
                        <th>Detalles del Seguimiento</th>
                        <th>Gasto y Moneda</th>
                        <th>Estado Actual </th>
                        <th>Evidencia Fotográfica del Seguimientos </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($seguimientos as $seguimiento)
                    <tr>
                        
                        
                        <td>{{ $seguimiento->visita->visita }}</td>
                       

                        <td> {{ $seguimiento->detalle_segui}} </td>

                         <td> {{ $seguimiento->gasto}} {{ $seguimiento->moneda}}</td>

                         <td> {{ $seguimiento->estado_actual}}</td>

                           @if ($seguimiento->evidencia_segui)
                            @php
                                $fotos = json_decode($seguimiento->evidencia_segui); // Decodifica el JSON
                            @endphp
                            @if (is_array($fotos))
                                @foreach ($fotos as $foto)
                                    @php
                                        $imagePath = public_path('evidencia_segui/seguimientos/' . $foto);
                                    @endphp
                                    @if (file_exists($imagePath))
                                        <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents($imagePath)) }}" 
                                             alt="Comprobante" 
                                             style="max-width: 100px; height: auto; margin-bottom: 5px;"> 
                                        {{-- Ajusta max-width según tus necesidades --}}
                                    @else
                                        <p>Imagen no encontrada: {{ $foto }}</p>
                                    @endif
                                @endforeach
                            @else
                                {{-- Si 'evidencia_segui' no es un JSON array pero existe un solo nombre de archivo --}}
                                @php
                                    $imagePath = public_path('evidencia_segui/seguimientos/' . $seguimiento->evidencia_segui);
                                @endphp
                                @if (file_exists($imagePath))
                                    <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents($imagePath)) }}" 
                                         alt="Comprobante" 
                                         style="max-width: 100px; height: auto;">
                                @else
                                    <p>Imagen no encontrada: {{ $seguimiento->evidencia_segui }}</p>
                                @endif
                             @endif
                        @else
                            No disponible
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row">
                <img class="footer-image" src="../public/img/portada2.png" alt="Pie de Pagina">
            </div>

    </body>
{{-- Index del PDF --}}

</html>