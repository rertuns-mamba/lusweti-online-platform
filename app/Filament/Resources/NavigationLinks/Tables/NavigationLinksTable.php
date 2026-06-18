<?php

namespace App\Filament\Resources\NavigationLinks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class NavigationLinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label'),
            TextColumn::make('url'),
            ToggleColumn::make('is_active'),
        ])
        ->defaultSort('order')
        ->reorderable('order') // Drag & Drop support
        ->actions([EditAction::make(), DeleteAction::make()]);
}}