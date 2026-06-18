<?php

namespace App\Filament\Resources\SpotiMajuus\Pages;

use App\Filament\Resources\SpotiMajuus\SpotiMajuuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSpotiMajuu extends EditRecord
{
    protected static string $resource = SpotiMajuuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
