<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Hero;
use App\Models\Package;
use Livewire\Component;

class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.landing-page', [
            'packages' => Package::latest()->get(),
            'articles' => Article::latest()->get(),
            'hero' => Hero::latest()->first()
        ])->layout('layouts.app');
    }
}
