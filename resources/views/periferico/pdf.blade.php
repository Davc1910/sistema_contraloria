<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Visita</title>
</head>

{{-- Estilo al PDF --}}
<style>

body{
    margin: 0;
	padding: 0;
    background: url(../img/portada2.png);
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

}

tbody. tr. td{
    border: 2px solid rgb(153, 44, 44);
}

img {

    margin-left: 17.5%;
    width: 600px;
    height: 22px;
  
}

.centro{
    margin-left: 10.5%;
    width: 80%;
    height: 10%; 
  border-radius: 8% 
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
{{-- Estilo al PDF --}}

{{-- Index del PDF --}}
    <body>

        <div class="row">
            <img class="centro" src="../public/img/portada2.png" alt="">
        </div>
        
        <div class="date-info" style="">
            Generado el: {{ now()->format('d/m/Y H:i:s') }}
        </div>
        
        <h1>Datos del Visita</h1><br>
            <table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.4rem;front-size:0.6rem !important">
                <thead class="header">
                    <tr>
                        <th>Parroquia</th>
                        <th>Comunidad</th>
                        <th>Visitas</th>
                        <th>Descripción</th>
                        <th>Evidencia de la visita</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($visitas as $visita)
                    <tr>
                        <td>
                            @if ($visita->parroquia)
                                {{$visita->parroquia->nom_parroquia }} @else
                            @endif
                        </td>

                        <td>
                            {{ $visita->comunidad->nom_comuni }}
                        </td>

                        <td>
                            {{ $visita->visita }} 
                        </td>

                        <td>                         
                            {{ $visita->descripcion_vis}} 
                        </td>

                        <td>
                        {{-- Mostrar las imágenes si existen --}}
                        @if ($visita->evidencia)
                            @php
                                $fotos = json_decode($visita->evidencia); // Decodifica el JSON
                            @endphp
                            @if (is_array($fotos))
                                @foreach ($fotos as $foto)
                                    @php
                                        $imagePath = public_path('evidencia/visitas/' . $foto);
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
                                {{-- Si 'evidencia' no es un JSON array pero existe un solo nombre de archivo --}}
                                @php
                                    $imagePath = public_path('evidencia/visitas/' . $visita->evidencia);
                                @endphp
                                @if (file_exists($imagePath))
                                    <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents($imagePath)) }}" 
                                         alt="Comprobante" 
                                         style="max-width: 100px; height: auto;">
                                @else
                                    <p>Imagen no encontrada: {{ $visita->evidencia }}</p>
                                @endif
                            @endif
                        @else
                            No disponible
                        @endif
                    </td>
                        
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