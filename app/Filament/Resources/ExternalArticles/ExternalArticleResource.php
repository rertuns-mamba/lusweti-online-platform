<?php

namespace App\Filament\Resources\ExternalArticles;

use App\Filament\Resources\ExternalArticles\Pages\CreateExternalArticle;
use App\Filament\Resources\ExternalArticles\Pages\EditExternalArticle;
use App\Filament\Resources\ExternalArticles\Pages\ListExternalArticles;
use App\Filament\Resources\ExternalArticles\Schemas\ExternalArticleForm;
use App\Filament\Resources\ExternalArticles\Tables\ExternalArticlesTable;
use App\Models\ExternalArticle;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExternalArticleResource extends Resource
{
    protected static ?string $model = ExternalArticle::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ExternalArticle';

    public static function form(Schema $schema): Schema
    {
        return ExternalArticleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExternalArticlesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExternalArticles::route('/'),
            'create' => CreateExternalArticle::route('/create'),
            'edit' => EditExternalArticle::route('/{record}/edit'),
        ];
    }
}
