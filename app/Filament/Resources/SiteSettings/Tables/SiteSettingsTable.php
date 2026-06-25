<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tagline')
                    ->searchable()
                    ->sortable()
                    ->label('Tagline'),

                TextColumn::make('display_date')
                    ->date('M j, Y')
                    ->sortable()
                    ->label('Display Date'),

                TextColumn::make('updated_at')
                    ->dateTime('M j, Y h:i A')
                    ->sortable()
                    ->label('Last Updated'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->defaultSort('updated_at', 'desc');
    }
}
