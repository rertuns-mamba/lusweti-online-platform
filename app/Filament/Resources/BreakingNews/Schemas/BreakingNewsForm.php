<?php

namespace App\Filament\Resources\BreakingNews\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms\Components\DateTimePicker as ComponentsDateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput as ComponentsTextInput;
use Filament\Forms\Components\Toggle as ComponentsToggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Set;

class BreakingNewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Group::make()
                    ->schema([
                        Section::make('Headline Content')
                            ->schema([
                                ComponentsTextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                        if ($operation === 'create') {
                                            $set('original_title', $state);
                                        }
                                    }),

                                Hidden::make('original_title'),

                                ComponentsTextInput::make('url')
                                    ->label('Destination URL')
                                    ->url()
                                    ->required()
                                    ->maxLength(255),

                                // ComponentsTextInput::make('ai_title')
                                //     ->label('AI Optimized Title')
                                //     ->helperText('Overrides the main title if provided.')
                                //     ->maxLength(255),

                                ComponentsDateTimePicker::make('expires_at')
                                    ->label('Auto-Expire Date')
                                    ->helperText('Leave blank to keep active indefinitely.'),

                                ComponentsTextInput::make('priority')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Higher numbers appear first.'),


                            ]),

                        // Section::make('Media')
                        //     ->schema([
                        //         ComponentsSpatieMediaLibraryFileUpload::make('featured_image')
                        //             ->collection('featured_image')
                        //             ->image()
                        //             ->imageEditor()
                        //             ->columnSpanFull(),
                        //     ]),
                    ])
                    ->columnSpan(['sm' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Display Status')
                            ->schema([
                                ComponentsToggle::make('is_active')
                                    ->label('Active in Ticker')
                                    ->default(true),

                                ComponentsToggle::make('is_live')
                                    ->label('Show LIVE Badge')
                                    ->helperText('Displays the white/red LIVE indicator.')
                                    ->default(false),

                                ComponentsToggle::make('is_urgent')
                                    ->label('Mark as Urgent')
                                    ->helperText('Pushes this item to the front of the queue.')
                                    ->default(false),

                                ComponentsDateTimePicker::make('expires_at')
                                    ->label('Auto-Expire Date')
                                    ->helperText('Leave blank to keep active indefinitely.'),

                                ComponentsTextInput::make('priority')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Higher numbers appear first.'),
                            ]),

                        // Section::make('Metrics (Read Only)')
                        //     ->schema([
                        //         ComponentsTextInput::make('views')
                        //             ->numeric()
                        //             ->disabled(),
                        //         ComponentsTextInput::make('clicks')
                        //             ->numeric()
                        //             ->disabled(),
                        //         ComponentsTextInput::make('ai_score')
                        //             ->numeric()
                        //             ->disabled(),
                        //     ])
                        //     ->hiddenOn('create'),
                    ])
                    ->columnSpan(['sm' => 1]),
            ])
            ->columns(3);
    }
}
