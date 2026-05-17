<?php

namespace App\Filament\Resources\JobVacancies\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class JobVacancyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('school_id')
                    ->required()
                    ->numeric(),
                TextInput::make('department_id')
                    ->required()
                    ->numeric(),
                TextInput::make('position_id')
                    ->required()
                    ->numeric(),
                TextInput::make('employee_category_id')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('quota')
                    ->required()
                    ->numeric()
                    ->default(1),
                DatePicker::make('open_date')
                    ->required(),
                DatePicker::make('close_date'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
