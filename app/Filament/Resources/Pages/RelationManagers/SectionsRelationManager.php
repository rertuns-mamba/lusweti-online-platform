<?php

namespace App\Filament\Resources\Pages\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->defaultSort('sort_order', 'asc') // Automatically order by your sort_order column
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('component')
                    ->badge() // Makes the component string look cleaner in the table
                    ->sortable(),
                
                TextColumn::make('sort_order')
                    ->sortable(),
                
                ToggleColumn::make('is_active'), // Allows toggling active status directly from the table
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}