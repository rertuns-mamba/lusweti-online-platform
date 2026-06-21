<?php

namespace App\Filament\Resources\ExternalArticles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExternalArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Source Details')->schema([
                TextInput::make('title')->required(),
                TextInput::make('external_url')->url()->required(),
                Select::make('category_id')->relationship('category', 'name')->required(),
            ]),
            
            Section::make('Media')->schema([
                SpatieMediaLibraryFileUpload::make('featured_image')
                    ->collection('featured_image')
                    ->image()
                    ->imageEditor(),
            ]),

            TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->alphaDash()
                            ->validationMessages([
                                'required' => 'The slug is required.',
                                'unique' => 'This slug is already in use.',
                                'alpha_dash' => 'The slug may only contain letters, numbers, dashes, and underscores.',
                            ]),
            ])->columns(3);
    }
}
