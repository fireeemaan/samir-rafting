<!DOCTYPE html>
<html class="scroll-smooth">

<head>
    <title>{{ $title ?? 'Wisata Desa Bantal' }}</title>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" /> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @filamentStyles
</head>

<body>
    <div class="text-gray-800 font-sans flex justify-center w-">
        {{ $slot }}
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script> --}}
    @livewireScripts
    @filamentScripts
</body>

</html>
