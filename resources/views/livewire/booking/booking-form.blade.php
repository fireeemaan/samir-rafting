<div class="flex w-full min-h-[100vh] items-center justify-center">
    <div
        class="w-full max-w-5xl bg-white rounded-2xl shadow-xl grid grid-cols-1 md:grid-cols-2 gap-8 p-8 border border-black/10">
        <!-- Detail Paket -->
        <div class="space-y-4">
            <img src="{{ asset('storage/' . $package->thumbnail) }}" alt="Thumbnail Paket"
                class="w-full h-64 object-cover rounded-xl shadow-md" />
            <h2 class="text-2xl font-bold">{{ $package->name }}</h2>
            <p class="text-lg text-blue-600 font-semibold">
                Rp {{ number_format($package->price, 0, ',', '.') }} / pax
            </p>
            <p class="text-gray-700">
                {{ $package->description }}
            </p>
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">
                    Fasilitas Termasuk:
                </h3>
                <ul class="list-disc list-inside text-gray-600 space-y-1">
                    @foreach ($package->facilities ?? [] as $facility)
                        <li>{{ $facility['facility'] ?? '' }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Form Booking -->
        <div x-data="{
                jumlah: @entangle('jumlah'),
                harga: {{ $package->price }},
                get total() { return this.jumlah * this.harga }
            }">
            <h2 class="text-2xl font-bold mb-4">Form Booking</h2>
            <form wire:submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block font-medium mb-1" for="tanggal">Tanggal Booking</label>
                    <input type="date" wire:model="tanggal" name="tanggal"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring focus:ring-blue-300"
                        required />
                    @error('tanggal')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block font-medium mb-1" for="jumlah">Jumlah Tiket</label>

                    <div class="flex items-center gap-2">
                        <button type="button" @click="jumlah = Math.max(1, jumlah - 1)"
                            class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300 cursor-pointer">-</button>
                        <input type="number" wire:model="jumlah" min="1"
                            class="w-20 text-center border border-gray-300 rounded-xl px-2 py-2 focus:ring focus:ring-blue-300">
                        <button type="button" @click="jumlah = jumlah + 1"
                            class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300 cursor-pointer">+</button>
                    </div>
                    @error('jumlah')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block font-medium mb-1" for="nama">Atas Nama</label>
                    <input type="text" wire:model.defer="nama" name="nama"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring focus:ring-blue-300"
                        required />
                </div>
                <div>
                    <label class="block font-medium mb-1" for="email">Email</label>
                    <input type="email" wire:model.defer="email" name="email"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring focus:ring-blue-300"
                        required />
                </div>
                <div>
                    <label class="block font-medium mb-1" for="hp">Nomor HP</label>
                    <input type="tel" wire:model.defer="hp" name="hp"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring focus:ring-blue-300"
                        required />
                </div>
                <div>
                    <label class="block font-medium mb-1">Total Harga</label>
                    <p class="text-lg font-semibold text-green-600">
                        Rp <span x-text="total.toLocaleString('id-ID')"></span>
                    </p>
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold px-6 py-3 rounded-xl hover:bg-blue-700 transition">
                    Booking Sekarang
                </button>
            </form>
        </div>
    </div>
</div>
