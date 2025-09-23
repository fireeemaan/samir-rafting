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
                <div
                    class="bg-gray-50 p-6 rounded-2xl shadow hover:shadow-xl transition flex flex-col justify-between overflow-hidden">
                    <div>
                        {{-- THUMBNAIL --}}
                        <div class="mb-4 -mx-6 -mt-6">
                            <img src="{{ !empty($package->thumbnail) ? asset('storage/' . $package->thumbnail) : 'https://placehold.co/600x400?text=' . urlencode($package->name) }}"
                                alt="Thumbnail {{ $package->name }}" class="w-full h-48 md:h-56 object-cover"
                                loading="lazy">
                        </div>

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
                            {{-- TOMBOL LOKASI --}}
                            @if (!empty($package->location_url))
                                <a href="{{ $package->location_url }}" target="_blank" rel="noopener"
                                    class="inline-block bg-white border border-gray-300 hover:bg-gray-100 text-gray-800 font-semibold px-4 py-2 rounded-full">
                                    Lihat Lokasi
                                </a>
                            @endif

                            {{-- TOMBOL PESAN --}}
                            @if ($package->price > 0)
                                <a href="{{ route('booking', $package) }}"
                                    class="inline-block bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-full">
                                    Pesan
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
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit(Str::of($article->body_html ?: $article->body)->stripTags()->squish(),100) }}
                        </p>
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
    <footer class="relative bg-gray-900 text-gray-200">
        <!-- Decorative top border/stripe -->
        <div class="h-1 w-full bg-gradient-to-r from-amber-400 via-yellow-400 to-amber-400"></div>

        <div class="px-6 md:px-20 py-14">
            <div class="grid gap-10 md:grid-cols-3 max-w-6xl mx-auto">
                <!-- Brand -->
                <div>
                    <h3 class="text-2xl font-bold text-white">Desa Wisata Bantal</h3>
                    <p class="mt-3 text-gray-400">
                        Wisata terpadu di tepi Sungai Samir: arung jeram, jelajah alam & kuliner khas.
                    </p>
                    <div class="mt-5 flex items-center gap-3">
                        <!-- Instagram -->
                        <a href="https://instagram.com/samirrafting.situbondo" target="_blank" rel="noopener"
                            class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 hover:bg-white/10 transition">
                            <!-- IG icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm5 3.5A5.5 5.5 0 1 1 6.5 13 5.51 5.51 0 0 1 12 7.5zm0 2A3.5 3.5 0 1 0 15.5 13 3.5 3.5 0 0 0 12 9.5zM17.75 6a1.25 1.25 0 1 1-1.25 1.25A1.25 1.25 0 0 1 17.75 6z" />
                            </svg>
                            <span class="font-semibold">@samirrafting.situbondo</span>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold text-white">Jelajah</h4>
                    <ul class="mt-4 space-y-2 text-gray-300">
                        <li><a href="#paket" class="hover:text-amber-400 transition">Paket Wisata</a></li>
                        <li><a href="#galeri" class="hover:text-amber-400 transition">Galeri Desa</a></li>
                        <li><a href="#artikel" class="hover:text-amber-400 transition">Artikel & Tips</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition">Tentang</a></li>
                    </ul>
                </div>

                <!-- Contact / CTA -->
                <div>
                    <h4 class="text-lg font-semibold text-white">Kontak</h4>
                    <p class="mt-4 text-gray-300">Nomor HP: <span
                            class="font-semibold text-white">+6285231353030</span></p>

                    <div class="mt-5 flex flex-wrap gap-3">
                        <!-- WhatsApp CTA -->
                        <a href="https://wa.me/6285231353030?text=Halo%20Desa%20Wisata%20Bantal%2C%20saya%20ingin%20tanya%20soal%20paket%20wisata."
                            target="_blank" rel="noopener"
                            class="inline-flex items-center gap-2 rounded-xl bg-yellow-400 px-5 py-2.5 font-semibold text-black hover:bg-yellow-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.02-.24 11.36 11.36 0 0 0 3.56.57 1 1 0 0 1 1 1v3.61a1 1 0 0 1-1 1A17.79 17.79 0 0 1 3 6a1 1 0 0 1 1-1h3.61a1 1 0 0 1 1 1 11.36 11.36 0 0 0 .57 3.56 1 1 0 0 1-.24 1.02l-2.32 2.21z" />
                            </svg>
                            WhatsApp Sekarang
                        </a>

                        <!-- Call -->
                        <a href="tel:+6285231353030"
                            class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-5 py-2.5 font-semibold hover:bg-white/10 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.02-.24 11.36 11.36 0 0 0 3.56.57 1 1 0 0 1 1 1v3.61a1 1 0 0 1-1 1A17.79 17.79 0 0 1 3 6a1 1 0 0 1 1-1h3.61a1 1 0 0 1 1 1 11.36 11.36 0 0 0 .57 3.56 1 1 0 0 1-.24 1.02l-2.32 2.21z" />
                            </svg>
                            Telepon
                        </a>

                        <!-- Website Desa -->
                        <a href="https://bantal.desa.id/" target="_blank" rel="noopener"
                            class="inline-flex items-center gap-2 rounded-xl border border-amber-400/40 bg-amber-400/10 px-5 py-2.5 font-semibold hover:bg-amber-400/20 transition">
                            <!-- globe icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M12 2a10 10 0 1 0 .001 20.001A10 10 0 0 0 12 2Zm0 2c1.43 0 2.75.37 3.9 1H8.1A7.96 7.96 0 0 1 12 4Zm-6.32 3h12.64c.43.62.77 1.3 1 2H4.68c.23-.7.57-1.38 1-2Zm-1.3 4h15.24c.05.33.08.66.08 1s-.03.67-.08 1H4.38a8.6 8.6 0 0 1-.08-2Zm.3 4h14.64c-.23.7-.57 1.38-1 2H5.68c-.43-.62-.77-1.3-1-2ZM8.1 19h7.8A7.96 7.96 0 0 1 12 20c-1.43 0-2.75-.37-3.9-1Z" />
                            </svg>
                            Kunjungi Website Desa
                        </a>
                    </div>

                    <p class="mt-3 text-sm text-gray-400">
                        IG: <a href="https://instagram.com/samirrafting.situbondo" target="_blank" rel="noopener"
                            class="hover:text-amber-400">@samirrafting.situbondo</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Bottom mini-bar -->
        <div class="border-t border-white/10">
            <div
                class="px-6 md:px-20 py-6 max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-3">
                <p class="text-sm text-gray-400">&copy; {{ now()->year }} Desa Wisata Bantal. Semua hak dilindungi.
                </p>
                <div class="flex items-center gap-4 text-sm">
                    <a href="#paket" class="hover:text-amber-400 transition">Paket</a>
                    <a href="#galeri" class="hover:text-amber-400 transition">Galeri</a>
                    <a href="#artikel" class="hover:text-amber-400 transition">Artikel</a>
                    <a href="https://bantal.desa.id/" target="_blank" rel="noopener"
                        class="hover:text-amber-400 transition">Website Desa</a>
                </div>
            </div>
        </div>
    </footer>


</div>
