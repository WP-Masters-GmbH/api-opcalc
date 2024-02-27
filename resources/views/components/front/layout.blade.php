<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="{{ url('/libs/year-picker/datepicker.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/libs/font-awesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('/libs/tabulator/tabulator.min.css') }}">
    <link rel="stylesheet" href="{{ url('/libs/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('/libs/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/style.css?' . time()) }}">
    <link rel="stylesheet" href="{{ url('/assets/vr_style.css?' . time()) }}">
    <script src="{{ url('/libs/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ url('/build/assets/app.css?'. time()) }}">
</head>
<body>
    <x-front.header></x-front.header>
    {{ $slot }}

    <script src="{{ url('/libs/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('/libs/charts/chart.min.js') }}"></script>
    <script src="{{ url('/libs/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ url('/libs/font-awesome/all.min.js') }}"></script>
    <script src="{{ url('/libs/year-picker/datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('/libs/tabulator/tabulator.min.js') }}"></script>
    <script src="{{ url('/libs/select2/select2.min.js') }}"></script>
    <script src="{{ url('/assets/main.js?' . time()) }}"></script>
    <script src="{{ url('/assets/vr_main.js?' . time()) }}"></script>
    @empty($script)
        @else
        <script src="{{ url("/assets/pages/{$script}.js?" . time()) }}"></script>
    @endempty
    <x-front.footer></x-front.footer>
</body>
</html>
