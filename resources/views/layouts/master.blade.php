<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <div id="app" class="flex-center position-ref full-height">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
    <footer>
        {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEEuYTxsoUTB5EEyd_z1upqlCzl7X1RQg"></script> --}}
        <script src="{{ mix('js/app.js') }}"></script>
    </footer>
</html>
