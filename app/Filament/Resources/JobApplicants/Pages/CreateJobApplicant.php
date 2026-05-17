<?php

namespace App\Filament\Resources\JobApplicants\Pages;

use App\Filament\Resources\JobApplicants\JobApplicantResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJobApplicant extends CreateRecord
{
    protected static string $resource = JobApplicantResource::class;
}
