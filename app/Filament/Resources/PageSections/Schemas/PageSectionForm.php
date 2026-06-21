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
                    ->required()
                    ->validationMessages([
                        'required' => 'The page is required.',
                    ]),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->minLength(3)
                    ->validationMessages([
                        'required' => 'The section title is required.',
                        'min' => 'The title must be at least 3 characters.',
                        'max' => 'The title cannot exceed 255 characters.',
                    ]),

                Select::make('component')
                    ->label('Section Layout Style')
                    ->live()
                    ->options([
                        'sections.magazine-home' => 'Magazine Master Layout',
                        'sections.hero' => 'Hero Section',
                        'sections.spoti-kenya' => 'Spoti Kenya Custom Block',
                        'sections.spoti-majuu-block' => 'Spoti Majuu Block',
                        'sections.featured-articles' => 'Featured Articles',
                        'sections.editorial-grid-block' => 'Editorial Grid Block',
                        'sections.breaking-news' => 'Breaking News',
                        'sections.galleries' => 'Galleries',
                        'sections.videos' => 'Videos',
                        'sections.external-feed' => 'External Feed',
                    ])
                    ->required()
                    ->validationMessages([
                        'required' => 'The component is required.',
                    ]),

                Select::make('model_type')
                    ->label('Content Type')
                    ->options([
                        'App\Models\Article' => 'Articles',
                        'App\Models\Video' => 'Videos',
                    ])
                    ->required()
                    ->validationMessages([
                        'required' => 'The content type is required.',
                    ]),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->helperText('Filter content by category (optional)'),

                KeyValue::make('settings')
                    ->label('Section Filters & Configurations')
                    ->helperText('Example -> Key: category_slug | Value: sports')
                    ->keyLabel('Configuration Key')
                    ->valueLabel('Value')
                    ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->helperText('Lower numbers appear first.'),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),

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
                    ->visible(fn (Get $get) => $get('component') === 'sections.magazine-home'),
            ]);
    }
}
