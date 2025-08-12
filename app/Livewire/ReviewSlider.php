<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;

class ReviewSlider extends Component
{
    public $reviews;

    protected $listeners = [
        'review-created' => '$refresh'
    ];

    public function mount()
    {
        $this->reviews = Review::where('is_accepted', true)->latest()->get();
    }

    public function render()
    {
        return view('livewire.review-slider');
    }
}
