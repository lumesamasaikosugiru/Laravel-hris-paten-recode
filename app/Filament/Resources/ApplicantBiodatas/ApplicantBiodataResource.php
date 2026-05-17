<?php

namespace App\Filament\Resources\ApplicantBiodatas;

use App\Filament\Resources\ApplicantBiodatas\Pages\CreateApplicantBiodata;
use App\Filament\Resources\ApplicantBiodatas\Pages\EditApplicantBiodata;
use App\Filament\Resources\ApplicantBiodatas\Pages\ListApplicantBiodatas;
use App\Filament\Resources\ApplicantBiodatas\Schemas\ApplicantBiodataForm;
use App\Filament\Resources\ApplicantBiodatas\Tables\ApplicantBiodatasTable;
use App\Models\Recruitment\ApplicantBiodata;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ApplicantBiodataResource extends Resource
{
    protected static ?string $model = ApplicantBiodata::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationLabel = 'Biodata Pelamar';
    protected static string|UnitEnum|null $navigationGroup = 'Recruitment';
    protected static ?string $recordTitleAttribute = 'fullname';

    public static function form(Schema $schema): Schema
    {
        return ApplicantBiodataForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApplicantBiodatasTable::configure($table);
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
            'index' => ListApplicantBiodatas::route('/'),
            'create' => CreateApplicantBiodata::route('/create'),
            'edit' => EditApplicantBiodata::route('/{record}/edit'),
        ];
    }
}
