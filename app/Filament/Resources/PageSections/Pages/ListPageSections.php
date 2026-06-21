<?php

namespace App\Filament\Resources\PageSections\Pages;

use App\Filament\Resources\PageSections\PageSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListPageSections extends ListRecords
{
    protected static string $resource = PageSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function mounted(): void
    {
        parent::mounted();

        $this->listenForPageSectionUpdates();
    }

    protected function listenForPageSectionUpdates(): void
    {
        if (! Auth::check()) {
            return;
        }

        $this->js(<<<'JS'
            document.addEventListener('DOMContentLoaded', function() {
                if (window.Echo) {
                    window.Echo.channel('page-sections')
                        .listen('.page-section.mutated', (event) => {
                            window.dispatchEvent(new CustomEvent('filament-resource-list-reload'));
                        });
                }
            });
        JS);
    }
}
