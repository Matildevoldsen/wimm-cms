<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/575b0d96b5.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script type="text/javascript">
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
    </script>

    <meta name="theme-color" content="#FFFFFF" />


    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}"/>
</head>
<body>
<div id="app">
    <app></app>
</div>
<script type="text/javascript" src="{{ mix('js/main.js') }}"></script>
</body>
</html>
