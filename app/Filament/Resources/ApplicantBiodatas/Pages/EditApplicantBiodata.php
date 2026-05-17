<?php

namespace App\Filament\Resources\ApplicantBiodatas\Pages;

use App\Filament\Resources\ApplicantBiodatas\ApplicantBiodataResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditApplicantBiodata extends EditRecord
{
    protected static string $resource = ApplicantBiodataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
