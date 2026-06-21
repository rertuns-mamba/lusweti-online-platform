<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->minLength(3)
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn (?string $state, callable $set) => $set('slug', Str::slug($state))
                    )
                    ->validationMessages([
                        'required' => 'The page title is required.',
                        'min' => 'The title must be at least 3 characters.',
                        'max' => 'The title cannot exceed 255 characters.',
                    ]),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->alphaDash()
                    ->helperText('Frontend URL slug.')
                    ->validationMessages([
                        'required' => 'The slug is required.',
                        'unique' => 'This slug is already in use.',
                        'alpha_dash' => 'The slug may only contain letters, numbers, dashes, and underscores.',
                    ]),

                ColorPicker::make('bg_color')
                    ->label('Background Color')
                    ->default('#111827')
                    ->required(),

                ColorPicker::make('text_color')
                    ->label('Text Color')
                    ->default('#FFFFFF')
                    ->required(),

                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('published')
                    ->required(),

                Toggle::make('is_visible_in_nav')
                    ->label('Show In Navigation')
                    ->default(true),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->helperText('Lower numbers appear first.'),

            ]);
    }
}
