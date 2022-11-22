<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
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
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Fecha inicio: {{$fecha_ini}}</th>
                            <th style="text-align: center;">Fecha final: {{$fecha_fin}}</th>
                        </tr>
                        <tr>
                            <th>Gestion</th>
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
            <br><br><br><br><br><br><br><br>
            <div class="col-sm-12 text-left mb-4">
                <p class="texto font-weight-bold">Resultados:</p>
            </div>

            <div class="col-sm-12 text-left mb-4">

                <p class="texto font-weight-normal">- Total de gestiones: {{ $cantidad }}</p>
                <p class="texto font-weight-normal">- Gestiones pendientes: {{ $faltantes }}</p>
                <p class="texto font-weight-normal">- Total de procesos: {{ $total }}</p>
                <p class="texto font-weight-normal">- Porcentaje de cumplimiento: {{ $cumplimiento }}</p>

            </div>

            <div class="col-sm-6 text-left mt-5">
                <p class="texto font-weight-normal mb-4"> Contacta </p>
            </div>

        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous">
    </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous">
    </script>
</body>

</html>
