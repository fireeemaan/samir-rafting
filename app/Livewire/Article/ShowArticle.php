<?php

namespace App\Livewire\Article;

use App\Models\Article;
use Livewire\Component;

class ShowArticle extends Component
{
    public Article $article;

    public function render()
    {
        return view('livewire.article.show-article')
            ->layout('layouts.app', ['title' => $this->article->title]);
    }


}
