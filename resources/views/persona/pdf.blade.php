<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Personas</title>

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

    <h1>Reporte de Personas</h1>

    <table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.4rem;font-size:0.6rem !important">
        <thead class="header">
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Oficina</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($personas as $persona)
                <tr>
                    <td>{{ $persona->cedula }}</td>
                    <td>{{ $persona->nombre }}</td>
                    <td>{{ $persona->apellido }}</td>
                    <td>{{ $persona->email }}</td>
                    <td>{{ $persona->telefono }}</td>
                    <td>{{ $persona->oficina->nombre_oficina ?? 'N/A' }}</td>
                </tr>
            @endforeach 
        </tbody>
    </table>
    <div class="row">
        {{-- Pie de página: Asegúrate de usar Base64 también aquí --}}
       
    </div>
</body>
</html>