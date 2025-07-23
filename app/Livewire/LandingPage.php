<?php

namespace App\Livewire;

use App\Models\Package;
use Livewire\Component;

class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.landing-page', [
            'packages' => Package::latest()->get()
        ])->layout('layouts.app');
    }
}
