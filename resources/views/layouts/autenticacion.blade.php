<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title', 'Iniciar Sesion')</title>
    @vite('/resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('/resources/css/auth.css')
</head>

<body>

    <body>
        <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
            <div class="card shadow-sm w-100" style="max-width: 400px;">
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>

</html>