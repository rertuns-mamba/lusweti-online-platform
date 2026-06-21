<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function mounted(): void
    {
        parent::mounted();

        $this->listenForPageUpdates();
    }

    protected function listenForPageUpdates(): void
    {
        if (! Auth::check()) {
            return;
        }

        $this->js(<<<'JS'
            document.addEventListener('DOMContentLoaded', function() {
                if (window.Echo) {
                    window.Echo.channel('pages')
                        .listen('.page.mutated', (event) => {
                            window.dispatchEvent(new CustomEvent('filament-resource-list-reload'));
                        });
                }
            });
        JS);
    }
}
