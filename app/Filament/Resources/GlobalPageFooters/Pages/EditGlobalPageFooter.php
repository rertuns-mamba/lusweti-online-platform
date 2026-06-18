<?php

namespace App\Filament\Resources\GlobalPageFooters\Pages;

use App\Filament\Resources\GlobalPageFooters\GlobalPageFooterResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGlobalPageFooter extends EditRecord
{
    protected static string $resource = GlobalPageFooterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
