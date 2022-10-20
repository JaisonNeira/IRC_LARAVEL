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

                    <p class="texto font-weight-normal"> Para dudas o sugerencias contacte a la Mesa de Ayuda.</p>
                </div>

                <div class="col-sm-6 text-right mt-5 mar-b text-justify">
                    {{-- Variables del servidor --}}
                    <p class="texto font-weight-normal"> Datos del proceso para cuando se solicite seguimiento a la Mesa de Ayuda:</p>
                    <p class="texto font-weight-normal text"> <mark class="resaltado">GUID: e70e425b-9264-4385-8660-8aa9c25f1bda</mark></p>
                    <p class="texto font-weight-normal text"> <mark class="resaltado">493A109D242BDB1E32F411A660561758</mark></p>
                    <p class="texto font-weight-normal text"> <mark class="resaltado">Fecha y Hora del (Servidor): 2021-12-15 09:37:57.212 PM</mark></p>
                </div>




                {{-- Otra Hoja--}}
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
                    <p class="texto text-left m-b4">Para dudas o sugerencias contacte a la Mesa de Ayuda.</p>
                </div>

                <div class="col-sm-12 text-left">
                    {{--  aaa--}}
                    <p class="texto text-left m-b4"><mark class="resaltado">Datos del proceso para cuando se solicite seguimiento a la Mesa de Ayuda: </mark> </p>
                    <p class="texto text-left m-b4"><mark class="resaltado">GUID: E70E425B-9264-4385-8660-8AA9C25F1BDA</mark> </p>
                    <p class="texto text-left m-b4"><mark class="resaltado">MD5: BB65BE8DBA3793F3F1DA8DCFBC86637F</mark> </p>
                    <p class="texto text-left m-b4"><mark class="resaltado">Fecha y Hora del (Servidor): 2021-12-15 21:38:35 PM </mark> </p>
                </div>


            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
