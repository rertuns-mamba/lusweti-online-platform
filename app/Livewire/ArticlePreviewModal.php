<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\On;

class ArticlePreviewModal extends Component
{
    public ?Article $article = null;
    public bool $isOpen = false;

    // Listen for the event dispatched by your article cards
    #[On('open-article-preview')]
    public function loadArticle(Article $article)
    {
        $this->article = $article;
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        // Optional: clear the article to free memory
        // $this->reset('article'); 
    }

    public function render()
    {
        return view('livewire.article-preview-modal');
    }
}