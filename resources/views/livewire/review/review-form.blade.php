<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8">
    <h2 class="text-2xl font-bold text-center mb-6">Tulis Review Anda</h2>

    <form wire:submit.prevent="submit" class="space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Anda</label>
            <input type="text" wire:model.defer="name"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                placeholder="Masukkan nama" />
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>

            <div x-data="{ localRating: @entangle('rating').defer }" class="flex items-center gap-2 select-none">
                @for ($i = 1; $i <= 5; $i++)
                    <button type="button" x-on:click="localRating = {{ $i }}"
                        class="focus:outline-none cursor-pointer" aria-label="Set rating {{ $i }}">
                        <svg class="w-8 h-8 transition fill-current"
                            :class="localRating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300'"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97a1 1 0 00.95.69h4.178c.969 0
                       1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364
                       1.118l1.287 3.97c.3.921-.755
                       1.688-1.54 1.118l-3.385-2.46a1
                       1 0 00-1.176
                       0l-3.385 2.46c-.784.57-1.838-.197-1.539-1.118l1.287-3.97a1
                       1 0 00-.364-1.118l-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178a1
                       1 0 00.95-.69l1.286-3.97z" />
                        </svg>
                    </button>
                @endfor
            </div>


            @error('rating')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Komentar</label>
            <textarea rows="5" wire:model.defer="comment"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                placeholder="Ceritakan pengalaman Anda..."></textarea>
            @error('comment')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-center gap-3">
            <button type="button" x-on:click="$dispatch('close-review-modal')"
                class="px-5 py-3 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium transition">
                Batal
            </button>
            <button type="submit"
                class="px-6 py-3 rounded-md bg-yellow-400 hover:bg-yellow-500 text-black font-semibold transition">
                Kirim Review
            </button>
        </div>

    </form>
</div>

<script>
    // Debug script
    console.log('Page loaded, looking for swiper element...');
    console.log('Swiper element found:', document.querySelector('.reviews-swiper'));
    console.log('Number of slides:', document.querySelectorAll('.swiper-slide').length);
</script>
