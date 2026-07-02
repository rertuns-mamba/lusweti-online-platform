<?php

namespace App\Filament\Resources\Cubes\Pages;

use App\Filament\Resources\Cubes\CubeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCubes extends ListRecords
{
    protected static string $resource = CubeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
