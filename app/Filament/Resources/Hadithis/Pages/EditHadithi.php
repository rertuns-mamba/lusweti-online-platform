<?php

namespace App\Filament\Resources\Hadithis\Pages;

use App\Filament\Resources\Hadithis\HadithiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHadithi extends EditRecord
{
    protected static string $resource = HadithiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
