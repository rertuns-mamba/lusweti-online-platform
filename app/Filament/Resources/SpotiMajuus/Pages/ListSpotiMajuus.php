<?php

namespace App\Filament\Resources\SpotiMajuus\Pages;

use App\Filament\Resources\SpotiMajuus\SpotiMajuuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSpotiMajuus extends ListRecords
{
    protected static string $resource = SpotiMajuuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
