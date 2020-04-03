<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Install: {{ config('app.name') }}</title>
    <!-- Scripts -->
    <script>
        window.wimm = {
            settings: {
                name: "{{ config('app.name') }}",
                meta: null,
                logoLocation: null,
                appUrl: "{{ config('app.url') }}"
            }
        }
    </script>

    <script type="text/javascript">
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
    </script>
    
    <!--- PWA --->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#FFFFFF" />
</head>
<body>
<noscript>
    This website uses JavaScript. Please make sure it is enabled in order to continue.
</noscript>
<div id="app">
    <App></App>
</div>
<script type="text/javascript" src="{{ mix('js/setup.js') }}"></script>
</body>
</html>
