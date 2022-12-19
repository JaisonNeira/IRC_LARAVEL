<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('img/error.svg')}}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;700&display=swap" rel="stylesheet">
    <style>
        .titulo {
            font-family: 'Mulish', sans-serif;
            font-size: 100px;
            color: rgb(241, 28, 28) !important;
            font-weight: bolder;
            font-stretch: 2px;
        }

        .text {
            font-family: 'Mulish', sans-serif;
            font-size: 18px;
        }

        .h {
            height: 500px
        }

        .img {
            background-image: linear-gradient(330deg, rgba(0, 0, 0, 0.7) 0%, rgba(24, 3, 5, 0.7) 41%), url(https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80);
            position: relative;
            background-size: cover;
        }
        .trasparent{
            background-color: rgba(253, 253, 253);
            opacity: 70%;
        }
    </style>


</head>

<body class="img">
    <div class="container-fluid">
        <div class="row h flex m-5 p-2 shadow-lg  rounded trasparent" >
            <div class="col-4 p-2" style="text-align:start;">
                <img src="{{asset('img/logocontacta.jpg')}}"
                style="max-width: 100px; max-height: 35px;">
            </div>
            <div class="col-4">
                <div style="padding-top:50px;">
                    <h1 class="text-center titulo">Error<br>@yield('code')</h1>
                    <p class="text text-center">@yield('message')</p>
                </div>
            </div>
            <div class="col-4 p-2" style="text-align:end;">
                <img src="{{asset('img/IRCicon 1.png')}}"
                style="max-width: 200px; max-height: 35px;">
            </div>

        </div>
    </div>
</body>

</html>
