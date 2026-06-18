<?php

namespace App\Filament\Resources\Hadithis\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HadithiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Editorial Content')->schema([
                    TextInput::make('title')->required()->live(onBlur: true)
                        ->afterStateUpdated(fn($state, $set) => $set('slug', str()->slug($state))),
                    TextInput::make('slug')->required(),
                    Select::make('category_id')
                        ->relationship('category', 'name') // Standardized taxonomy
                        ->required(),
                    Textarea::make('summary')->rows(3),
                    RichEditor::make('content')->columnSpanFull(),
                ])->columnSpan(2),

                Section::make('Settings & Media')->schema([
                    Toggle::make('is_prime')->label('Premium Hadithi?'),
                    Toggle::make('is_visible')->default(true),
                    DateTimePicker::make('published_at')->default(now()),
                    SpatieMediaLibraryFileUpload::make('featured_image')
                        ->image()->imageEditor(),
                ])->columnSpan(1),
            ])->columns(3);
    }
}
