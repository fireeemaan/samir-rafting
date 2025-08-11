<div class="flex flex-col w-full">
    <section class="bg-cover bg-center h-screen relative bg-amber-300"
        style="background-image: url('{{ asset('storage/01K1B7A89MEZ3Y44Y9ABYHPXK0.jpg') }}');">
        <div
            class="absolute inset-0 bg-black/50 bg-opacity-50 flex flex-col justify-center items-center text-white text-center px-4">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 drop-shadow-lg">{{ $hero->title }}</h1>
            <p class="text-xl md:text-2xl mb-6 max-w-2xl drop-shadow-md">{{ $hero->subtitle }}</p>
            <a href="#paket"
                class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-xl transition">{{ $hero->button_text }}</a>
        </div>
    </section>

    <section class="py-20 px-6 md:px-20 bg-gray-50 text-center">
        <h2 class="text-4xl font-bold mb-6">Tentang Rafting Samir</h2>
        <p class="text-lg max-w-3xl mx-auto text-gray-600">Kami adalah penyedia rafting profesional yang beroperasi di
            Sungai
            Samir, menawarkan pengalaman arung jeram terbaik bagi pemula maupun petualang berpengalaman. Dengan
            instruktur
            berlisensi dan perlengkapan standar internasional, keselamatan dan kesenangan Anda adalah prioritas kami.
        </p>
    </section>


    <section id="paket" class="py-20 px-6 md:px-20 bg-white">
        <h2 class="text-4xl font-bold text-center mb-12">Paket Wisata</h2>
        <div class="grid md:grid-cols-2 gap-8">

            @foreach ($packages as $package)
                <div
                    class="bg-gray-100 p-6 rounded-2xl shadow hover:shadow-xl transition flex flex-col justify-between">
                    <div class="information">
                        <h3 class="text-2xl font-semibold mb-2">{{ $package->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $package->description }}</p>
                        <ul class="grid grid-cols-1 sm:grid-cols-2 text-sm text-gray-700 mb-4 list-disc list-inside">
                            @foreach ($package->facilities ?? [] as $facility)
                                <li class="truncate w-full" title="{{ $facility['facility'] ?? '' }}">
                                    {{ $facility['facility'] ?? '' }}
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="price">
                        <p class="font-bold text-yellow-500 text-xl mb-4">
                            Rp{{ number_format($package->price, 0, ',', '.') }}/pax</p>
                        <a href="{{ route('booking', $package) }}"
                            class="inline-block bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-full self-start">Pesan
                            Sekarang</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <livewire:review-slider />


    <section class="py-20 px-6 md:px-20 bg-gray-100">
        <h2 class="text-4xl font-bold text-center mb-10">Artikel & Tips Seru</h2>

        <div class="flex gap-6 overflow-x-auto scroll-smooth pb-4">
            @foreach ($articles as $article)
                <div class="min-w-[300px] max-w-sm bg-white rounded-2xl shadow flex-shrink-0">
                    <img src="{{ asset('storage/' . $article->images[0]) }}" class="h-48 w-full object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $article->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($article->body, 100) }}</p>
                        <a href="#" class="text-yellow-500 font-semibold hover:underline">Baca Selengkapnya</a>
                    </div>
                </div>
            @endforeach

    </section>



    <section class="py-16 px-6 md:px-20 bg-yellow-400 text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Arungi Sungai Samir?</h2>
        <p class="text-lg mb-6">Booking sekarang dan dapatkan diskon khusus untuk grup!</p>
        <a href="#" class="bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800 transition">Booking
            Sekarang</a>
    </section>

    <footer class="bg-gray-900 text-white py-10 text-center">
        <p>&copy; 2025 Rafting Samir. All rights reserved.</p>
    </footer>
</div>
