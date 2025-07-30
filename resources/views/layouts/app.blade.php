<!DOCTYPE html>
<html class="scroll-smooth">
<head>
    <title>{{ $title ?? "Samir Rafting" }}</title>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="container bg-white text-gray-800 font-sans">
        {{ $slot }}
    </div>
    @livewireScripts
</body>
</html>
