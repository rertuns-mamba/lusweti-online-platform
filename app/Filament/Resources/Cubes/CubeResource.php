<?php

namespace App\Filament\Resources\Cubes;

use App\Filament\Resources\Cubes\Pages\CreateCube;
use App\Filament\Resources\Cubes\Pages\EditCube;
use App\Filament\Resources\Cubes\Pages\ListCubes;
use App\Filament\Resources\Cubes\Schemas\CubeForm;
use App\Filament\Resources\Cubes\Tables\CubesTable;
use App\Models\Cube;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CubeResource extends Resource
{
    protected static ?string $model = Cube::class;

    protected static string|BackedEnum|null $navigationIcon = "heroicon-o-cube";
    protected static string | \UnitEnum | null $navigationGroup = 'Site Structure';

    protected static ?string $recordTitleAttribute = '3D Cube Settings ';

    public static function form(Schema $schema): Schema
    {
        return CubeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CubesTable::configure($table);
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
            'index' => ListCubes::route('/'),
            'create' => CreateCube::route('/create'),
            'edit' => EditCube::route('/{record}/edit'),
        ];
    }
}
