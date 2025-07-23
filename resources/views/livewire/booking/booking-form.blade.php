@extends('layouts.app')

@section('title', 'Booking')

@section('content')
    <div class="max-w-xl mx-auto px-4 py-10">
        <h2 class="text-3xl font-bold mb-6 text-center">Formulir Pemesanan</h2>

        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="submit" class="space-y-4">
            <div>
                <label class="block mb-1 font-semibold">Nama Lengkap</label>
                <input wire:model="name" type="text" class="w-full border rounded px-3 py-2" />
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold">Email</label>
                <input wire:model="email" type="email" class="w-full border rounded px-3 py-2" />
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold">Nomor HP</label>
                <input wire:model="phone" type="text" class="w-full border rounded px-3 py-2" />
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold">Paket Rafting</label>
                <select wire:model="paket" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Paket --</option>
                    <option value="paket5">Paket 5 KM - Rp175.000</option>
                    <option value="paket7">Paket 7 KM - Rp200.000</option>
                </select>
                @error('paket') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold">Jumlah Peserta</label>
                <input wire:model="jumlah" type="number" min="1" class="w-full border rounded px-3 py-2" />
                @error('jumlah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold">Tanggal Rafting</label>
                <input wire:model="tanggal" type="date" class="w-full border rounded px-3 py-2" />
                @error('tanggal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            @if ($paket)
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
                    <strong>Total Harga:</strong> Rp{{ number_format($this->total, 0, ',', '.') }}
                </div>
            @endif

            <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-2 rounded">
                Kirim Pemesanan
            </button>
        </form>
    </div>
@endsection
