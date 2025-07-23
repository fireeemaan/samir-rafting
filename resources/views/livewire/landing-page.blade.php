@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="bg-cover bg-center h-screen relative" style="background-image: url('https://images.unsplash.com/photo-1629248457649-b082812aea6c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white text-center px-4">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 drop-shadow-lg">Rafting Samir</h1>
            <p class="text-xl md:text-2xl mb-6 max-w-2xl drop-shadow-md">Petualangan seru menyusuri sungai penuh tantangan! Siap basah dan beraksi?</p>
            <a href="#paket" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-xl transition">Lihat Paket Rafting</a>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="py-20 px-6 md:px-20 bg-gray-50 text-center">
        <h2 class="text-4xl font-bold mb-6">Tentang Rafting Samir</h2>
        <p class="text-lg max-w-3xl mx-auto text-gray-600">Kami adalah penyedia rafting profesional yang beroperasi di Sungai Samir, menawarkan pengalaman arung jeram terbaik bagi pemula maupun petualang berpengalaman. Dengan instruktur berlisensi dan perlengkapan standar internasional, keselamatan dan kesenangan Anda adalah prioritas kami.</p>
    </section>


    <section id="paket" class="py-20 px-6 md:px-20 bg-white">
        <h2 class="text-4xl font-bold text-center mb-12">Paket Wisata</h2>
        <div class="grid md:grid-cols-2 gap-8">

            @foreach ($packages as $package)
                <div class="bg-gray-100 p-6 rounded-2xl shadow hover:shadow-xl transition flex flex-col justify-between">
                    <div class="information">
                        <h3 class="text-2xl font-semibold mb-2">{{ $package->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $package->description }}</p>
                        <ul class="text-sm text-gray-700 mb-4 list-disc list-inside">
                            @foreach ($package->facilities ?? [] as $facility)
                                <li>{{ $facility['facility'] ?? '' }}</li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="price">
                        <p class="font-bold text-yellow-500 text-xl mb-4">Rp{{ number_format($package->price, 0, ',', '.') }}/pax</p>
                        <a href="{{ route('booking', $package) }}" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-full self-start">Pesan Sekarang</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="py-16 px-6 md:px-20 bg-yellow-400 text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Arungi Sungai Samir?</h2>
        <p class="text-lg mb-6">Booking sekarang dan dapatkan diskon khusus untuk grup!</p>
        <a href="#" class="bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800 transition">Booking Sekarang</a>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-10 text-center">
        <p>&copy; 2025 Rafting Samir. All rights reserved.</p>
    </footer>
@endsection
