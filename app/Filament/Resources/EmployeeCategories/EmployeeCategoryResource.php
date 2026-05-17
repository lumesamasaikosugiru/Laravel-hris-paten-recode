<?php

namespace App\Filament\Resources\EmployeeCategories;

use App\Filament\Resources\EmployeeCategories\Pages\CreateEmployeeCategory;
use App\Filament\Resources\EmployeeCategories\Pages\EditEmployeeCategory;
use App\Filament\Resources\EmployeeCategories\Pages\ListEmployeeCategories;
use App\Filament\Resources\EmployeeCategories\Schemas\EmployeeCategoryForm;
use App\Filament\Resources\EmployeeCategories\Tables\EmployeeCategoriesTable;
use App\Models\Master\EmployeeCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EmployeeCategoryResource extends Resource
{
    protected static ?string $model = EmployeeCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Jenis Kepegawaian';
    protected static string|UnitEnum|null $navigationGroup = 'Master Data';
    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Schema $schema): Schema
    {
        return EmployeeCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployeeCategoriesTable::configure($table);
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
            'index' => ListEmployeeCategories::route('/'),
            'create' => CreateEmployeeCategory::route('/create'),
            'edit' => EditEmployeeCategory::route('/{record}/edit'),
        ];
    }
}
