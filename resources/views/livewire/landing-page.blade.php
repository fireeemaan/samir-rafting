<div class="flex flex-col w-full">
    <!-- HERO -->
    <section class="bg-cover bg-center h-screen relative bg-amber-300"
        style="background-image: url('{{ asset('storage/' . $hero->hero_image) }}');">
        <div
            class="absolute inset-0 bg-black/50 bg-opacity-50 flex flex-col justify-center items-center text-white text-center px-4">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 drop-shadow-lg">{{ $hero->title }}</h1>
            <p class="text-xl md:text-2xl mb-6 max-w-2xl drop-shadow-md">{{ $hero->subtitle }}</p>
            <a href="#paket"
                class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-xl transition">{{ $hero->button_text }}</a>
        </div>
    </section>

    <!-- TENTANG DESA -->
    <section class="py-20 px-6 md:px-20 bg-gray-50 text-center">
        <h2 class="text-4xl font-bold mb-6">Tentang Desa Wisata Bantal</h2>
        <p class="text-lg max-w-3xl mx-auto text-gray-600">
            Desa Bantal adalah destinasi wisata terpadu di tepi Sungai Samir. Selain arung jeram, nikmati jelajah alam,
            serta kuliner khas. Cocok untuk keluarga, kantor, maupun komunitas.
        </p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-sm">Arung Jeram Samir</span>
            <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-sm">Jelajah Alam & Desa</span>
            <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-sm">Kuliner Khas</span>
        </div>
    </section>

    <section id="paket" class="py-20 px-6 md:px-20 bg-white">
        <h2 class="text-4xl font-bold text-center mb-12">Paket Wisata Desa Bantal</h2>
        <div class="grid md:grid-cols-2 gap-8 max-w-6xl mx-auto">
            @foreach ($packages as $package)
                <div class="bg-gray-50 p-6 rounded-2xl shadow hover:shadow-xl transition flex flex-col justify-between">
                    <div>
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
                    <div class="flex items-center justify-between mt-4 w-full">
                        {{-- Tampilkan harga hanya jika lebih dari 0 --}}
                        @if ($package->price > 0)
                            <p class="font-bold text-yellow-500 text-xl">
                                Rp{{ number_format($package->price, 0, ',', '.') }} /pax
                            </p>
                        @endif

                        <div class="flex items-center gap-2 ml-auto">
                            {{-- TOMBOL PESAN: hanya jika harga > 0 --}}
                            @if ($package->price > 0)
                                <a href="{{ route('booking', $package) }}"
                                    class="inline-block bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-full">
                                    Pesan
                                </a>
                            @endif

                            {{-- TOMBOL LOKASI: muncul jika location_url tidak null/kosong --}}
                            @if (!empty($package->location_url))
                                <a href="{{ $package->location_url }}" target="_blank" rel="noopener"
                                    class="inline-block bg-white border border-gray-300 hover:bg-gray-100 text-gray-800 font-semibold px-4 py-2 rounded-full">
                                    Lihat Lokasi
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </section>


    <!-- TESTIMONI -->
    <livewire:review-slider />

    <!-- MODAL FORM REVIEW -->
    <div x-data="{ open: false }" x-on:open-review-modal.window="open=true" x-on:close-review-modal.window="open=false"
        x-cloak class="fixed inset-0 z-50 flex items-center justify-center" x-show="open" aria-modal="true"
        role="dialog">
        <div class="absolute inset-0 bg-black/50" x-on:click="open=false"></div>
        <div class="relative w-full max-w-2xl mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <livewire:review.review-form />
            </div>
        </div>
    </div>

    <!-- GALERI DARI ARTIKEL (pakai data $articles yang ada) -->
    <section id="galeri" class="py-20 px-6 md:px-20 bg-gray-100">
        <h2 class="text-4xl font-bold text-center mb-10">Galeri Desa</h2>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 max-w-6xl mx-auto">
            @foreach ($articles as $article)
                @if (!empty($article->images[0]))
                    <figure class="relative group rounded-2xl overflow-hidden shadow">
                        <img src="{{ asset('storage/' . $article->images[0]) }}" alt="{{ $article->title }}"
                            class="h-48 w-full object-cover group-hover:scale-105 transition" loading="lazy">
                        <figcaption
                            class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white">
                            {{ $article->title }}</figcaption>
                    </figure>
                @endif
            @endforeach
        </div>
    </section>

    <!-- ARTIKEL -->
    <section id="artikel" class="py-20 px-6 md:px-20 bg-white">
        <h2 class="text-4xl font-bold text-center mb-10">Artikel & Tips Seru</h2>
        <div class="flex gap-6 overflow-x-auto scroll-smooth pb-4">
            @foreach ($articles as $article)
                <div class="min-w-[300px] max-w-sm bg-white rounded-2xl shadow flex-shrink-0">
                    <img src="{{ asset('storage/' . ($article->images[0] ?? '')) }}" class="h-48 w-full object-cover"
                        alt="{{ $article->title }}">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $article->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($article->body, 100) }}</p>
                        <a href="{{ route('article.show', $article) }}"
                            class="text-yellow-500 font-semibold hover:underline">Baca Selengkapnya</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 px-6 md:px-20 bg-yellow-400 text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Jelajahi Desa Bantal?</h2>
        <p class="text-lg mb-6">Booking sekarang dan rancang itinerary sesuai kebutuhan Anda.</p>
        <a href="#paket" class="bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800 transition">Lihat
            Paket</a>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-10 text-center">
        <p>&copy; 2025 Desa Wisata Bantal. Semua hak dilindungi.</p>
    </footer>
</div>
