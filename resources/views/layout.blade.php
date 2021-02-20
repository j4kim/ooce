<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>Oocé</title>
        
        <link rel="icon" type="image/png" href="{{ asset('icon-512.png') }}">
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body data-app-url="{{ env('APP_URL') }}">
        <div id="app">
            <header class="text-white bg-primary">
                <div class="p-2 container d-flex justify-content-between align-items-center">
                    <h1 class="m-0">
                        <a class="text-white text-decoration-none" href="{{ url('/') }}">
                            Oocé
                        </a>
                    </h1>
                    <interactive-search/>
                </div>
            </header>
            <main class="container pt-4">
                @yield('content')
            </main>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
