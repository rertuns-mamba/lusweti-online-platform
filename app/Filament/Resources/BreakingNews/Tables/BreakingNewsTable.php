<?php

namespace App\Filament\Resources\BreakingNews\Tables;

use App\Events\BreakingNewsUpdated;
use App\Models\BreakingNews;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class BreakingNewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('title')
                    ->searchable()
                    ->limit(50)
                    ->description(fn (BreakingNews $record): string => $record->url),

                ToggleColumn::make('is_active')
                    ->label('Active'),

                IconColumn::make('is_live')
                    ->label('Live')
                    ->boolean()
                    ->trueIcon('heroicon-o-video-camera')
                    ->trueColor('danger'),

                IconColumn::make('is_urgent')
                    ->label('Urgent')
                    ->boolean()
                    ->trueIcon('heroicon-o-exclamation-triangle')
                    ->trueColor('warning'),

                TextColumn::make('priority')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('expires_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
           
            ->filters([
                TernaryFilter::make('is_active'),
                TernaryFilter::make('is_live'),
                TernaryFilter::make('is_urgent'),
            ])
            
            ->defaultSort('priority', 'desc')
            
            ->actions([
                EditAction::make()
                    ->after(fn() => broadcast(new BreakingNewsUpdated())),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->after(fn() => broadcast(new BreakingNewsUpdated())),
                ]),
            ]);

        // ->actions([
        //     EditAction::make(),
        //     DeleteAction::make(),
        // ]);
    }
}
