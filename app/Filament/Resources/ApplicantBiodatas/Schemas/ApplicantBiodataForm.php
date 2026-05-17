<?php

namespace App\Filament\Resources\ApplicantBiodatas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ApplicantBiodataForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ktp')
                    ->required(),
                TextInput::make('fullname')
                    ->required(),
                Select::make('gender')
                    ->options(['L' => 'L', 'P' => 'P'])
                    ->required(),
                DatePicker::make('birthday')
                    ->required(),
                TextInput::make('birthplace')
                    ->default(null),
                TextInput::make('address_street')
                    ->required(),
                TextInput::make('address_district')
                    ->required(),
                TextInput::make('address_city')
                    ->required(),
                TextInput::make('address_province')
                    ->default(null),
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
                TextInput::make('ethnicity')
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('photo_path')
                    ->default(null),
            ]);
    }
}
