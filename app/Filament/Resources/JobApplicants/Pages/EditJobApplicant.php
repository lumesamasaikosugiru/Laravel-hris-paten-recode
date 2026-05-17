<?php

namespace App\Filament\Resources\JobApplicants\Pages;

use App\Filament\Resources\JobApplicants\JobApplicantResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJobApplicant extends EditRecord
{
    protected static string $resource = JobApplicantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
