<?php

namespace App\Livewire\Booking;

use App\Models\Package;
use Livewire\Component;

class BookingForm extends Component
{

    public Package $package;
    public $jumlah = 1;
    public $tanggal, $nama, $email, $hp;

    public string $target_phone = '6285231353030';

    public function getTotalProperty() {
        return $this->jumlah * $this->package->price;
    }

    // public function submit() {
    //     $this->validate([
    //         'name' => 'required|string|min:3',
    //         'email' => 'required|email',
    //         'phone' => 'required',
    //         'paket' => 'required',
    //         'jumlah' => 'required|integer|min:1',
    //         'tanggal' => 'required|date|after_or_equal:today'
    //     ]);

    //     session()->flash('success', 'Booking berhasil dikirim!');
    //     $this->reset();
    // }

    public function getWaLinkProperty(): string
    {
        $msg = "Paket : {$this->package->name}\n"
            . "Nama : {$this->nama}\n"
            . "Tanggal : {$this->tanggal}\n"
            . "Email : {$this->email}\n"
            . "No. HP : {$this->hp}";

        return 'https://wa.me/' . $this->target_phone . '?text=' . urlencode($msg);
    }

    public function sendWhatsapp()
    {
        $this->validate([
            'nama' => 'required|string|min:3',
            'email' => 'required|email',
            'hp' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date|after_or_equal:today'
        ]);

        return redirect()->away($this->waLink);
    }

    public function render()
    {
        return view('livewire.booking.booking-form')
            ->layout('layouts.app', ['title' => 'Booking']);
    }
}
