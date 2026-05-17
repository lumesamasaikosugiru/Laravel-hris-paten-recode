<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('applicant_biodata_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('user_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('school_id')
                    ->required()
                    ->numeric(),
                TextInput::make('employee_category_id')
                    ->required()
                    ->numeric(),
                TextInput::make('education_level_id')
                    ->required()
                    ->numeric(),
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('ktp')
                    ->required(),
                Select::make('gender')
                    ->options(['L' => 'L', 'P' => 'P'])
                    ->required(),
                TextInput::make('birthplace')
                    ->default(null),
                DatePicker::make('birthday')
                    ->required(),
                Select::make('marital_status')
                    ->options([
            'single' => 'Single',
            'married' => 'Married',
            'widowed' => 'Widowed',
            'divorced' => 'Divorced',
            'separated' => 'Separated',
        ])
                    ->required(),
                TextInput::make('religion')
                    ->default(null),
                TextInput::make('address')
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                TextInput::make('photo_path')
                    ->default(null),
                DatePicker::make('join_date')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('probation'),
                TextInput::make('nipy')
                    ->default(null),
                DateTimePicker::make('nipy_generated_at'),
                DatePicker::make('probation_end_date')
                    ->required(),
            ]);
    }
}
