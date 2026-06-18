<?php

namespace App\Filament\Resources\SidebarWidgets\Schemas;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Shemas\Components\Section  ;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section as ComponentsSection;

class SidebarWidgetForm
{
    public static function getFormSchema(): array
    {
        return [
            ComponentsSection::make('Widget Configuration')->schema([
                TextInput::make('title')->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->nullable()
                    ->helperText('Leave empty for a global widget.'),
            ]),

            ComponentsSection::make('Widget Content')->schema([
                Builder::make('content_data')
                    ->label('Content')
                    ->blocks([
                        Block::make('links')
                            ->schema([
                                Repeater::make('items')
                                    ->schema([
                                        TextInput::make('label')->required(),
                                        TextInput::make('url')->url()->required(),
                                    ])
                            ]),

                        Block::make('images')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('image')
                                    ->collection('sidebar-images')
                                    ->image()
                                    ->imageEditor()
                                    ->optimize('jpg')
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
        ];
    }
}           
