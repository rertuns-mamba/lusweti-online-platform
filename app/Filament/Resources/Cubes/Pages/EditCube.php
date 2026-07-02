<?php

namespace App\Filament\Resources\Cubes\Pages;

use App\Filament\Resources\Cubes\CubeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCube extends EditRecord
{
    protected static string $resource = CubeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
