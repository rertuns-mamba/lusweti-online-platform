<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function mounted(): void
    {
        parent::mounted();

        // Listen for real-time article updates via Reverb
        $this->listenForArticleUpdates();
    }

    protected function listenForArticleUpdates(): void
    {
        if (! Auth::check()) {
            return;
        }

        $this->js(<<<'JS'
            document.addEventListener('DOMContentLoaded', function() {
                if (window.Echo) {
                    window.Echo.channel('magazine-stream')
                        .listen('.article.mutated', (event) => {
                            // Refresh the table when articles are updated
                            window.dispatchEvent(new CustomEvent('filament-resource-list-reload'));
                        });
                }
            });
        JS);
    }
}
