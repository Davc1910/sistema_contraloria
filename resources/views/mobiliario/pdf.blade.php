<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Cargos</title>

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
        <img class="centro" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/portada2.png'))) }}" alt="Encabezado">
    </div>

    <h1>Reporte de Cargos</h1>

    <table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.4rem;font-size:0.6rem !important">
        <thead class="header">
            <tr>
                <th>Nombre Cargo</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cargos as $cargo)
                    <tr>
                        
                        <td>{{ $cargo->nombre_cargo }} 
                        
                        </td>
        
                        <td>{{ $cargo->categoria }}</td>

                        
                            
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