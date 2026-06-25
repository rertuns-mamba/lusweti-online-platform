<?php

namespace App\Filament\Resources\Videos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema; // Standard Media Engine Component

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Video Identity')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')->required()->columnSpan(2),
                            Select::make('category_id')
                                ->relationship(
                                    name: 'category',
                                    titleAttribute: 'name',
                                )
                                ->getOptionLabelFromRecordUsing(fn ($record) => $record->name ?: ($record->title ?: 'Category '.$record->id))
                                ->required(),
                            Toggle::make('is_visible')->default(true),
                        ]),
                    ]),

                Section::make('Source Configuration')
                    ->schema([
                        // This 'live()' is critical for the switching logic
                        Toggle::make('is_youtube')
                            ->label('Is this a YouTube video?')
                            ->default(true)
                            ->live(),

                        // YouTube Field
                        TextInput::make('youtube_id')
                            ->label('YouTube Video ID')
                            ->helperText('The code at the end of the URL (e.g., dQw4w9WgXcQ)')
                            ->visible(fn ($get) => $get('is_youtube') === true),

                        // Local Upload Field (Spatie + FFmpeg Integration)
                        SpatieMediaLibraryFileUpload::make('local_video')
                            ->collection('local_video')
                            ->label('Upload Local Video')
                            ->acceptedFileTypes(['video/mp4', 'video/quicktime'])
                            ->maxSize(51200) // 50MB
                            ->visible(fn ($get) => $get('is_youtube') === false),
                    ]),
            ]);
    }
}
