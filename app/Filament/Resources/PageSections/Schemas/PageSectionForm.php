<?php

namespace App\Filament\Resources\PageSections\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class PageSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('page_id')
                    ->relationship('page', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Select::make('component')
                    ->label('Section Layout Style')
                    ->options([
                        'sections.magazine-home' => 'Magazine Master Layout',
                        'sections.hero-news'            => 'Hero News',
                        'sections.spoti-kenya'          => 'Spoti Kenya Custom Block',
                        'sections.business-news'        => 'Business News Custom Block',
                        'sections.featured-articles'    => 'Featured Articles',
                    ])
                    ->required(),

                KeyValue::make('settings')
                    ->label('Section Filters & Configurations')
                    ->helperText('Example -> Key: category_slug | Value: sports')
                    ->keyLabel('Configuration Key')
                    ->valueLabel('Value')
                    ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_active')
                    ->default(true),


                Section::make('Section Configuration')->schema([
                    TextInput::make('title')->required(),

                    Select::make('component')
                        ->options([
                            'sections.three-column' => 'Standard 3-Column Grid',
                            'sections.magazine-home' => 'BBC Magazine Layout', // <-- Added
                        ])
                        ->reactive() // Make it reactive so we can show/hide settings below
                        ->required(),

                    Select::make('model_type')
                        ->options([
                            'App\Models\Article' => 'Articles',
                            'App\Models\Video' => 'Videos',
                        ])->required(),

                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->nullable(),
                ])->columns(2),

                // THE POWER OF JSON SETTINGS
                Section::make('Magazine Layout Settings')
                    ->schema([
                        Toggle::make('settings.show_sidebar')
                            ->label('Show Right Sidebar')
                            ->default(true),
                        Toggle::make('settings.show_video')
                            ->label('Show Featured Video in Sidebar')
                            ->default(true),
                    ])
                    // Only show this box if the user selected the Magazine component!
                    ->visible(fn(Get $get) => $get('component') === 'sections.magazine-home'),
            ]);
    }
}
