<?php

namespace App\Filament\Resources\NavigationLinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NavigationLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('label')->required(),
                TextInput::make('url')->required(),
                Toggle::make('is_active')->default(true),
                Toggle::make('is_external')->label('Open in new tab'),
            ]);
    }
}
