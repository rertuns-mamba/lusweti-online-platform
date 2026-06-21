<?php

namespace App\Filament\Resources\GlobalPageFooters;

use App\Filament\Resources\GlobalPageFooters\Pages\CreateGlobalPageFooter;
use App\Filament\Resources\GlobalPageFooters\Pages\EditGlobalPageFooter;
use App\Filament\Resources\GlobalPageFooters\Pages\ListGlobalPageFooters;
use App\Filament\Resources\GlobalPageFooters\Schemas\GlobalPageFooterForm;
use App\Filament\Resources\GlobalPageFooters\Tables\GlobalPageFootersTable;
use App\Models\GlobalPageFooter;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class GlobalPageFooterResource extends Resource
{
    protected static ?string $model = GlobalPageFooter::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-down';

    protected static string | \UnitEnum | null $navigationGroup = 'Site Structure';

    protected static ?string $recordTitleAttribute = 'GlobalPageFooter';

    public static function form(Schema $schema): Schema
    {
        return GlobalPageFooterForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GlobalPageFootersTable::configure($table);
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
            'index' => ListGlobalPageFooters::route('/'),
            'create' => CreateGlobalPageFooter::route('/create'),
            'edit' => EditGlobalPageFooter::route('/{record}/edit'),
        ];
    }
}
