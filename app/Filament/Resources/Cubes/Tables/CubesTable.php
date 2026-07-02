<?php

namespace App\Filament\Resources\Cubes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CubesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('front'),
                // TextColumn::make('back'),
                // TextColumn::make('right'),
                // TextColumn::make('left'),
                TextColumn::make('top'),
                TextColumn::make('bottom'),
                TextColumn::make('updated_at')->dateTime(),
            ])->actions([
                EditAction::make(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
