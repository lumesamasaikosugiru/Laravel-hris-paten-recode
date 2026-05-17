<?php

namespace App\Filament\Resources\ApplicantBiodatas\Pages;

use App\Filament\Resources\ApplicantBiodatas\ApplicantBiodataResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApplicantBiodatas extends ListRecords
{
    protected static string $resource = ApplicantBiodataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
