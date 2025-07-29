<!DOCTYPE html>
<html class="scroll-smooth">
<head>
    <title>@yield('title')</title>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container bg-white text-gray-800 font-sans">
        @yield('content')
    </div>
</body>
</html>
