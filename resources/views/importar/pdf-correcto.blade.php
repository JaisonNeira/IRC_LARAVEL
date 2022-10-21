<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container-fluid justify-content-center">
        <div class="container contenido">
            <div class="row">
                <div class="col-sm-12 text-right mb-5">
                    <h1 class="font-weight-bold">Acta de Validación de cargue</h1>
                    <p class="texto"> <strong>Fecha </strong>Octubre 01 de 2022</p>
                    <p class="texto font-weight-bold"> Barranquilla-Atlántico </p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <h2 class="font-weight-bold">Srs. Riesgo Cardiovascular Y Obstetrico Irc S.A.S.</h2>
                    <p class="texto font-weight-bold">NIT: 900781044</p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto font-weight-normal">Resultados de la Validación de la Estructura del Archivo:</p>
                    <p class="texto font-weight-normal"><mark class="resaltado">SEG500USIN20211215NI000900781044.TXT</mark>  ( según nombre de archivo que se convenga. formato de cargue)</p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    {{-- Variable de la fecha y hora de recepcion--}}
                    <p class="texto font-weight-normal">Fecha y Hora de Recepción: "2021-12-15 09:37:45 PM"</p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto font-weight-bold">La Estructura del Archivo es Correcta</p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto font-weight-normal">El archivo pasa a ser entregado al área de gestión para completar su procesamiento.</p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    {{-- Variable de numero de registros --}}
                    <p class="texto font-weight-normal">- Número de registros leídos: </p>
                    {{-- Variable de numero de registros duplicados --}}
                    <p class="texto font-weight-normal">- Número de registros duplicados: </p>
                    {{-- Variable de numero de registros cargados --}}
                    <p class="texto font-weight-normal">- Número de registros cargados:</p>
                </div>

                <div class="col-sm-6 text-left mt-5">
                    <p class="texto font-weight-normal mb-4"> Contacta </p>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
