<?php

namespace App\Filament\Resources\GlobalPageFooters\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GlobalPageFootersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('brand_name')
                    ->searchable()
                    ->sortable()
                    ->label('Brand'),

                TextColumn::make('brand_description')
                    ->limit(30)
                    ->label('Description'),

                TextColumn::make('copyright_text')
                    ->limit(30)
                    ->label('Copyright'),

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
