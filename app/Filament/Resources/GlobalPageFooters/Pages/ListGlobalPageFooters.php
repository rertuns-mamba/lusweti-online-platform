<?php

namespace App\Filament\Resources\GlobalPageFooters\Pages;

use App\Filament\Resources\GlobalPageFooters\GlobalPageFooterResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGlobalPageFooters extends ListRecords
{
    protected static string $resource = GlobalPageFooterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
