<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Especifico</title>
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

    <div class="date-info">
        Generado el: {{ now()->format('d/m/Y H:i:s') }}
    </div>

    <h1>Reporte Especifico</h1>

    <table class="table">
        <thead class="header">
            <tr>
                 <th>Responsable del Seguimiento</th>
                 <th>Proyecto Asigando y Tipo</th>
                 <th>Dirección / Lugar</th>
                 <th>Impacto Ambiental Y Social</th>
                 <th>Estado Actual /Cantidad de Beneficiados</th>
                 <th>Gasto y moneda </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resultados as $resultado)  
                </tr>
                     <td >{{ $resultado->cedula}}
                     {{ $resultado->nombre}} {{ $resultado->apellido}}
                     </td>

                     <td >{{ $resultado->nombre_pro}}
                       {{ $resultado->tipo_pro}} 
                     </td>
                                            
                     <td >{{ $resultado->direccion }}
                     </td>

                     <td >{{ $resultado->impacto_ambiental}}
                       {{ $resultado->impacto_social }}  
                        </td>

                        <td >{{ $resultado->estado_actual}}
                         {{ $resultado->cantidad_bene}}
                        </td>

                    <td >{{ $resultado->gasto}}
                     {{ $resultado->moneda}} 
                       </td>
                </tr>
            @endforeach 
        </tbody>
    </table>
    <div class="row">
        <img class="footer-image" src="../public/img/portada2.png" alt="Pie de Página">
    </div>
</body>
</html>