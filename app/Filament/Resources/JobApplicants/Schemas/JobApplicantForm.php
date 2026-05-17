<?php

namespace App\Filament\Resources\JobApplicants\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JobApplicantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('job_vacancy_id')
                    ->required()
                    ->numeric(),
                TextInput::make('applicant_biodata_id')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options([
            'applied' => 'Applied',
            'screening' => 'Screening',
            'interview' => 'Interview',
            'accepted' => 'Accepted',
            'rejected' => 'Rejected',
        ])
                    ->default('applied')
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
                DateTimePicker::make('applied_at')
                    ->required(),
            ]);
    }
}
