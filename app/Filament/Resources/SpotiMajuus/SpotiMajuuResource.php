<?php

namespace App\Filament\Resources\SpotiMajuus;

use App\Filament\Resources\SpotiMajuus\Pages\CreateSpotiMajuu;
use App\Filament\Resources\SpotiMajuus\Pages\EditSpotiMajuu;
use App\Filament\Resources\SpotiMajuus\Pages\ListSpotiMajuus;
use App\Filament\Resources\SpotiMajuus\Schemas\SpotiMajuuForm;
use App\Filament\Resources\SpotiMajuus\Tables\SpotiMajuusTable;
use App\Models\SpotiMajuu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SpotiMajuuResource extends Resource
{
    protected static ?string $model = SpotiMajuu::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'SpotiMajuu';

    public static function form(Schema $schema): Schema
    {
        return SpotiMajuuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpotiMajuusTable::configure($table);
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
            'index' => ListSpotiMajuus::route('/'),
            'create' => CreateSpotiMajuu::route('/create'),
            'edit' => EditSpotiMajuu::route('/{record}/edit'),
        ];
    }
}
