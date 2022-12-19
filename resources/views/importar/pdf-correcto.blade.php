<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 8 PDF</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        @foreach ($acta as $list)
            <div class="row">
                <div class="col-sm-12 text-right mb-5">
                    <h1 class="font-weight-bold">Acta de Validación de cargue</h1>
                    <p class="texto"> <strong>Fecha </strong><?php echo date('F d'); ?> de <?php echo date('Y'); ?></p>
                    <p class="texto font-weight-bold"> Barranquilla-Atlántico </p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <h2 class="font-weight-bold">Srs. Riesgo Cardiovascular Y Obstetrico Irc S.A.S.</h2>
                    <p class="texto font-weight-bold">NIT: 900781044</p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto font-weight-normal">Resultados de la Validación de la Estructura del Archivo:
                    </p>
                    <p class="texto font-weight-normal"><mark class="resaltado">{{ $list->Acc_nombre }}</mark></p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    {{-- Variable de la fecha y hora de recepcion --}}
                    <p class="texto font-weight-normal">Fecha y Hora de Recepción: {{ $list->created_at }}</p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto font-weight-bold">La Estructura del Archivo es Correcta</p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    <p class="texto font-weight-normal">El archivo pasa a ser entregado al área de gestión para
                        completar su procesamiento.</p>
                </div>

                <div class="col-sm-12 text-left mb-4">
                    {{-- Variable de numero de registros --}}
                    <p class="texto font-weight-normal">- Número de registros leídos: {{ $list->Acc_leidos }}</p>
                    {{-- Variable de numero de registros duplicados --}}
                    <p class="texto font-weight-normal">- Número de registros duplicados: {{ $list->Acc_duplicados }}
                    </p>
                    {{-- Variable de numero de registros cargados --}}
                    <p class="texto font-weight-normal">- Número de registros cargados: {{ $list->Acc_cargados }}</p>
                </div>

                <div class="col-sm-6 text-left mt-5">
                    <p class="texto font-weight-normal mb-4"> Contacta </p>
                </div>

            </div>
        @endforeach
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
