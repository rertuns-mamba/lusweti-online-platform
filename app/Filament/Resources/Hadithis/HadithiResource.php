<?php

namespace App\Filament\Resources\Hadithis;

use App\Filament\Resources\Hadithis\Pages\CreateHadithi;
use App\Filament\Resources\Hadithis\Pages\EditHadithi;
use App\Filament\Resources\Hadithis\Pages\ListHadithis;
use App\Filament\Resources\Hadithis\Schemas\HadithiForm;
use App\Filament\Resources\Hadithis\Tables\HadithisTable;
use App\Models\Hadithi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HadithiResource extends Resource
{
    protected static ?string $model = Hadithi::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-book-open';

    protected static string | \UnitEnum | null $navigationGroup = 'Religious Content';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return HadithiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HadithisTable::configure($table);
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
            'index' => ListHadithis::route('/'),
            'create' => CreateHadithi::route('/create'),
            'edit' => EditHadithi::route('/{record}/edit'),
        ];
    }
}
