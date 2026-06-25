<?php

namespace App\Filament\Resources\ExternalArticles\Tables;

use App\Models\ExternalArticle;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ExternalArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('featured_image')
                    ->collection('featured_image')
                    ->conversion('thumb')
                    ->circular(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn (ExternalArticle $record): ?string => Str::limit($record->summary, 40)),

                TextColumn::make('category.name')
                    ->sortable()
                    ->badge(),

                TextColumn::make('external_url')
                    ->url(fn (ExternalArticle $record): ?string => $record->external_url)
                    ->openUrlInNewTab()
                    ->limit(30),

                IconColumn::make('is_visible')
                    ->boolean()
                    ->label('Visible'),

                TextColumn::make('published_at')
                    ->dateTime('M j, Y h:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category')
                    ->preload(),

                TernaryFilter::make('is_visible')
                    ->label('Visibility'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }
}
