<?php

namespace App\Filament\Resources\GlobalPageFooters\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GlobalPageFooterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Footer Branding')->schema([
                    TextInput::make('brand_name')->required(),
                    TextInput::make('brand_description')->required(),
                    TextInput::make('copyright_text')->required(),
                ]),
                Section::make('Navigation')->schema([
                    TextInput::make('sections_title')->default('Explore'),
                    TextInput::make('information_title')->default('Information'),
                    Repeater::make('meta_links')->schema([
                        TextInput::make('title')->required(),
                        TextInput::make('url')->required()->url(),
                        Toggle::make('open_in_new_tab'),
                    ])->columns(2),
                ]),
            ]);
    }
}
