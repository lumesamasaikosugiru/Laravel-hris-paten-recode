<?php

namespace App\Filament\Resources\JobApplicants\Pages;

use App\Filament\Resources\JobApplicants\JobApplicantResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJobApplicants extends ListRecords
{
    protected static string $resource = JobApplicantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
