<div>
    <section class="py-20 px-6 md:px-20 bg-white">
        <h2 class="text-4xl font-bold text-center mb-12">Review Pengunjung</h2>

        <div class="swiper reviews-swiper h-[15rem]" wire:ignore>
            <div class="swiper-wrapper">
                @foreach ($reviews as $review)
                    <div class="swiper-slide bg-gray-100 p-6 rounded-2xl shadow flex flex-col">
                        <div class="flex items-center mb-4">
                            <div
                                class="w-12 h-12 rounded-full bg-yellow-400 flex items-center justify-center font-bold text-black">
                                {{ strtoupper(substr($review->name, 0, 1)) }}
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">{{ $review->name }}</h3>
                                <div class="flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <svg class="w-5 h-5 text-yellow-400 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.97c.3.921-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.176 0l-3.385 2.46c-.784.57-1.838-.197-1.539-1.118l1.287-3.97a1 1 0 00-.364-1.118l-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.97z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-300 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.97c.3.921-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.176 0l-3.385 2.46c-.784.57-1.838-.197-1.539-1.118l1.287-3.97a1 1 0 00-.364-1.118l-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.97z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-10 text-center">
            <button x-data x-on:click="$dispatch('open-review-modal')"
                class="inline-flex items-center gap-2 bg-black text-white px-6 py-3 rounded-xl hover:bg-gray-800 transition shadow-lg cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="font-semibold">Tulis Review</span>
            </button>
        </div>
    </section>
</div>
