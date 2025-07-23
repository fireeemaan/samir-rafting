<?php

namespace App\Livewire\Booking;

use Livewire\Component;

class BookingForm extends Component
{

    public $name, $email, $phone, $paket = '', $jumlah = 1, $tanggal;
    public $hargaPerPax = 0;

    public function updatedPaket($value) {
        $this->hargaPerPax = match ($value) {
            'paket5' => 175000,
            'paket7' => 200000,
            default => 0,
        };
    }

    public function getTotalProperty() {
        return $this->jumlah * $this->hargaPerPax;
    }

    public function submit() {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'paket' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date|after_or_equal:today'
        ]);

        session()->flash('success', 'Booking berhasil dikirim!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.booking.booking-form')
            ->layout('layouts.app');
    }
}
