<div class="flex flex-col w-full">

    {{-- Header mini ala portal --}}
    <section class="bg-gray-100 border-b border-gray-200">
        <div class="px-6 md:px-20 py-4 flex items-center justify-between">
            <div class="text-sm text-gray-600  ">
                <a href="{{ route('home') }}" class="hover:underline">Beranda</a>
                <span class="mx-2">/</span>
                <a href="" class="hover:underline">Artikel</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-medium line-clamp-1">{{ $article->title }}</span>
            </div>

            {{-- Tombol Back yang diminta --}}
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center gap-2 bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>
    </section>


    <section class="py-12 md:py-16 px-6 md:px-20 bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- KONTEN ARTIKEL --}}
            <article class="lg:col-span-8">
                <div class="bg-white rounded-2xl shadow p-6 md:p-8">

                    {{-- Gambar artikel --}}
                    @if (!empty($article->images[0]))
                        <img src="{{ asset('storage/' . $article->images[0]) }}" alt="{{ $article->title }}"
                            class="w-full max-w-4xl mx-auto rounded-xl shadow mb-6 object-cover h-[30rem]">
                    @endif

                    {{-- Judul & meta --}}
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $article->title }}</h1>
                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 mb-6">
                        <span>{{ $article->created_at->translatedFormat('d F Y') }}</span>
                        <span>•</span>
                        <span>Oleh <span class="font-semibold">{{ $article->author->name ?? 'Admin' }}</span></span>
                        @if (!empty($article->read_time))
                            <span>•</span>
                            <span>{{ $article->read_time }} menit baca</span>
                        @endif
                    </div>

                    {{-- Konten artikel --}}
                    <div class="prose prose-lg max-w-none prose-img:rounded-xl">
                        {!! $article->body_html ?? nl2br(e($article->body)) !!}
                    </div>

                    {{-- Tag --}}
                    @if (!empty($article->tags) && count($article->tags))
                        <div class="mt-8 flex flex-wrap gap-2">
                            @foreach ($article->tags as $tag)
                                <a href="{{ route('articles.tag', $tag) }}"
                                    class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-800 px-3 py-1 rounded-full transition">
                                    #{{ $tag }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </article>

            <aside class="lg:col-span-4">
                <div class="space-y-6">

                    {{-- Pencarian --}}
                    <div class="bg-white rounded-2xl shadow p-5">
                        <form action="" method="GET" class="flex gap-2">
                            <input type="text" name="q" value="{{ request('q') }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                                placeholder="Cari artikel...">
                            <button
                                class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-xl transition">
                                Cari
                            </button>
                        </form>
                    </div>

                    {{-- Terbaru --}}
                    @if (!empty($latest) && $latest->count())
                        <div class="bg-white rounded-2xl shadow p-5">
                            <h3 class="text-lg font-bold mb-4">Terbaru</h3>
                            <div class="space-y-4">
                                @foreach ($latest as $item)
                                    <a href="{{ route('articles.show', $item) }}" class="flex gap-3 group">
                                        <img src="{{ asset('storage/' . ($item->images[0] ?? 'placeholder.jpg')) }}"
                                            class="w-20 h-16 rounded-lg object-cover" alt="">
                                        <div>
                                            <p class="font-medium group-hover:underline line-clamp-2">
                                                {{ $item->title }}</p>
                                            <p class="text-xs text-gray-500">{{ $item->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Populer --}}
                    @if (!empty($popular) && $popular->count())
                        <div class="bg-white rounded-2xl shadow p-5">
                            <h3 class="text-lg font-bold mb-4">Populer</h3>
                            <ol class="space-y-3 list-decimal list-inside">
                                @foreach ($popular as $item)
                                    <li>
                                        <a href="{{ route('articles.show', $item) }}" class="hover:underline">
                                            {{ $item->title }}
                                        </a>
                                        <div class="text-xs text-gray-500">{{ number_format($item->views ?? 0) }}x
                                            dibaca</div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    @endif

                    {{-- Kategori --}}
                    @if (!empty($categories) && $categories->count())
                        <div class="bg-white rounded-2xl shadow p-5">
                            <h3 class="text-lg font-bold mb-4">Kategori</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($categories as $cat)
                                    <a href=""
                                        class="px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm transition">
                                        {{ $cat->name }} <span
                                            class="text-gray-500">({{ $cat->articles_count ?? $cat->articles()->count() }})</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </section>




    {{-- Artikel terkait (grid) --}}
    @if (!empty($related) && $related->count())
        <section class="py-16 px-6 md:px-20 bg-gray-50">
            <h2 class="text-3xl font-bold mb-8 text-center">Artikel Terkait</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($related as $rel)
                    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition">
                        <img src="{{ asset('storage/' . ($rel->images[0] ?? 'placeholder.jpg')) }}"
                            class="h-40 w-full object-cover rounded-t-2xl" alt="">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-2 line-clamp-2">{{ $rel->title }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($rel->excerpt ?? $rel->body), 120) }}</p>
                            <a href="{{ route('articles.show', $rel) }}"
                                class="text-yellow-500 font-semibold hover:underline">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif


    {{-- Footer (opsional, jika tidak pakai layout) --}}
    {{-- <footer class="bg-gray-900 text-white py-10 text-center">
        <p>&copy; 2025 Rafting Samir. All rights reser
