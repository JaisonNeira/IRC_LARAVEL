<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-12 text-right mb-5">
                <h1 class="font-weight-bold">Informe de gestiones realizadas</h1>
                <p class="texto"> <strong>Fecha: </strong><?php echo date('F d'); ?> de <?php echo date('Y'); ?></p>
                <p class="texto font-weight-bold"> Barranquilla-Atlántico </p>
            </div>

            <div class="col-sm-12 text-left mb-4">
                <h2 class="font-weight-bold">Srs. Riesgo Cardiovascular Y Obstetrico Irc S.A.S.</h2>
                <p class="texto font-weight-bold">NIT: 900781044</p>
            </div>

            <div class="col-sm-12 text-left mb-4">
                <p class="texto font-weight-normal">Cantidades de gestiones y sus tipos:
                </p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Fecha inicio: </th>
                            <th style="text-align: center;">Fecha final: </th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">Gestion</th>
                            <th style="text-align: center;">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gestiones as $list)
                            <tr>
                                <td>{{ $list->tge_nombre }}</td>
                                <td>{{ $list->cantidad }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="texto font-weight-normal"><mark class="resaltado"></mark></p>
            </div>

            <div class="col-sm-12 text-left mb-4">
                <p class="texto font-weight-bold">Resultados:</p>
            </div>

            <div class="col-sm-12 text-left mb-4">

                <p class="texto font-weight-normal">- Total de gestiones: {{ $cantidad }}</p>

            </div>

            <div class="col-sm-6 text-left mt-5">
                <p class="texto font-weight-normal mb-4"> Contacta </p>
            </div>

        </div>
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
