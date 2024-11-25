<!DOCTYPE html>
<html lang="en" class="h-100">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
        <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet">

    </head>

    <body class="h-100">
        @yield('content')
        
        <script src="{{asset('/assets/vendor/global/global.min.js')}}"></script>
        <script src="{{asset('/assets/js/quixnav-init.js')}}"></script>
        <script src="{{asset('/assets/js/custom.min.js')}}"></script>

    </body>

</html>