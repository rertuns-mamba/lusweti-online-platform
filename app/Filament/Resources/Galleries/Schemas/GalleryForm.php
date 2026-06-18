<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Gallery Metadata')->schema([
                    TextInput::make('title')->required(),
                    Select::make('category_id')
                        ->relationship('category', 'title')
                        ->required(),
                    Toggle::make('is_visible')->default(true),
                ]),
                Section::make('Media')->schema([
                    SpatieMediaLibraryFileUpload::make('gallery_cover')
                        ->collection('gallery_cover')
                        ->image()
                        ->imageEditor() // Allows editors to crop/rotate
                        ->required(),
                ]),
            ]);
    }
}
