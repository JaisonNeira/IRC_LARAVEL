<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>

</head>

<body>
    <div class="container-fluid justify-content-center">
        <div class="container contenido">
            <div class="row">

                <div class="col-sm-12 text-justify  text-right mb-5">
                    <h1 class="font-weight-bold">RESULTADO DE PROCESAMIENTO</h1>
                    {{-- Variable fecha y hora documento --}}
                    <p class="texto"> <strong>Fecha: </strong><?php $time = time(); echo date("d-m-Y (H:i:s)", $time);?></p>
                    {{-- Variable ciudad?¿ --}}
                    <p class="texto font-weight-bold"> Barranquilla-Atlántico </p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto"> Sres. <strong>RIESGO CARDIOVASCULAR Y OBSTETRICO IRC SAS (NI 900781044)</strong>
                    </p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto"> Resultados del procesamiento del archivo: <mark class="resaltado">
                            {{$nombre}}</mark></p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto"><strong>El archivo No se procesó debido a inconsistencias en el registro de
                            control, no se cargo ningun registro</strong></p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto"><strong>Resumen por tipo de error y/o advertencia encontrado:</strong></p>
                    {{-- Variable por tipo/adevertencia encotrada --}}

                    @foreach ($failures as $erros)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> {{ $erros->errors()[0] }} en la linea {{ $erros->row() }} </strong>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
</body>

</html>
