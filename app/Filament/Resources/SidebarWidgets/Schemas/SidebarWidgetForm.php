<?php

namespace App\Filament\Resources\SidebarWidgets\Schemas;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SidebarWidgetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Widget Configuration')->schema([
                    TextInput::make('title')->required(),
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->nullable()
                        ->helperText('Leave empty for a global widget.'),
                ]),

                Section::make('Widget Content')->schema([
                    Builder::make('content_data')
                        ->label('Content')
                        ->blocks([
                            Block::make('links')
                                ->schema([
                                    Repeater::make('items')
                                        ->schema([
                                            TextInput::make('label')->required(),
                                            TextInput::make('url')->url()->required(),
                                        ]),
                                ]),

                            Block::make('images')
                                ->schema([
                                    SpatieMediaLibraryFileUpload::make('image')
                                        ->collection('sidebar-images')
                                        ->image()
                                        ->imageEditor()
                                        ->required(),
                                    TextInput::make('caption'),
                                ]),

                            Block::make('video')
                                ->schema([
                                    TextInput::make('video_url')->url()->required(),
                                    TextInput::make('title'),
                                ]),

                            Block::make('related')
                                ->schema([
                                    Select::make('article_ids')
                                        ->multiple()
                                        ->relationship('articles', 'title')
                                        ->preload(),
                                ]),
                        ])
                        ->columnSpanFull(),
                ]),
            ]);
    }
}
