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

                <div class="col-sm-12 text-justify  text-right mb-5">
                    <h1 class="font-weight-bold">RESULTADO DE PROCESAMIENTO</h1>
                    {{-- Variable fecha y hora documento--}}
                    <p class="texto"> <strong>Fecha </strong>Octubre 01 de 2022</p>
                    {{-- Variable ciudad?¿ --}}
                    <p class="texto font-weight-bold"> Barranquilla-Atlántico </p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto"> Sres. <strong>RIESGO CARDIOVASCULAR Y OBSTETRICO IRC SAS (NI 900781044)</strong></p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto"> Resultados del procesamiento del archivo: <mark class="resaltado"> SEG500USIN20211215NI000900781044.txt</mark></p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    {{-- Variable fecha y hora de recepcion 2--}}
                    <p class="texto">- Fecha y Hora de Recepción: 2021-12-15 21:37:45 PM</p>
                    {{-- Variable registros leidos --}}
                    <p class="texto">- Registros leídos: </p>
                    {{-- Variable de registros con error --}}
                    <p class="texto">- Registros con error: <strong>0</strong></p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto"><strong>El archivo No se procesó debido a inconsistencias en el registro de control, no se cargo ningun registro</strong></p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto"><strong>Resumen por tipo de error y/o advertencia encontrado:</strong></p>
                    {{-- Variable por tipo/adevertencia encotrada --}}
                    <p class="texto text-justify"><strong>Error:</strong> Aqui va el error </p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto"><strong>Detalle de los primeros 500 errores y/o advertencias encontrados:</strong></p>
                    {{-- Variable de  los primeros 500 errores (baina random) --}}
                    <p class="texto text-justify"><strong>Error:</strong> Aqui va el error </p>
                </div>
                <div class="col-sm-12 text-left mb-4">
                    <p class="texto text-left m-b4">Contacta </p>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
