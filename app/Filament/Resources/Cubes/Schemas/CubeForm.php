<?php

namespace App\Filament\Resources\Cubes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CubeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('front')->required(),
                TextInput::make('back')->required(),
                TextInput::make('right')->required(),
                TextInput::make('left')->required(),
                TextInput::make('top')->required(),
                TextInput::make('bottom')->required(),
            ]);
    }
}
