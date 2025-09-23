<?php

namespace App\Livewire\Review;

use App\Models\Review;
use Filament\Notifications\Notification;
use Livewire\Component;

class ReviewForm extends Component
{

    public $name = '';
    public $rating = 5;
    public $comment = '';

    protected $rules = [
        'name' => 'required|string|min:2|max:100',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|min:10|max:1000'
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'rating.required' => 'Pilih rating.',
        'comment.required' => 'Komentar wajib diisi.',
    ];

    public function submit()
    {
        $this->validate();

        Review::create([
            'name' => $this->name,
            'rating' => (int) $this->rating,
            'comment' => $this->comment
        ]);

        $this->reset(['name', 'rating', 'comment']);
        $this->rating = 5;

        $this->dispatch('review-created');

        $this->dispatch('close-review-modal');

        Notification::make()
                ->title('Review Terkirim!')
                ->body('Terima kasih, review Anda akan kami tinjau terlebih dulu.')
                ->success()
                ->send();

    }

    public function render()
    {
        return view('livewire.review.review-form');
    }
}
