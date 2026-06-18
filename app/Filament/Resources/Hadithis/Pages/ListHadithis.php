<?php

namespace App\Filament\Resources\Hadithis\Pages;

use App\Filament\Resources\Hadithis\HadithiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHadithis extends ListRecords
{
    protected static string $resource = HadithiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
