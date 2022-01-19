<!DOCTYPE html>
<html lang="hu">
    <head>
        <title>HUN League Statisztika</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="css/style.css"> -->
        <link href = "{{asset('css/style.css')}}" rel = "stylesheet">
        @yield('css')
    </head>
    <body>
        <div class="header" id="myHeader">
            <div class="statisztika">Statisztika</div>
            <div class="navbar">
            <ul>
                <li><a href="/">Főoldal</a></li>
                <li><a href="/players">Játékosok</a></li>
                <li><a href="/matches">Mérkőzések</a></li>
                <li><a href="/admin/new-player">Új játékos</a></li>
                <li><a href="/admin/new-match">Új mérkőzés</a></li>
            </ul>
            </div>
        </div>
        @yield('content')
    </body>
    @yield('scripts')
</html>