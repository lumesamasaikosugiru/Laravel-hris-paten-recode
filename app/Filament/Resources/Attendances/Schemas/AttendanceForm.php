<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('employee_id')
                    ->required()
                    ->numeric(),
                TextInput::make('school_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('date')
                    ->required(),
                DateTimePicker::make('check_in_at'),
                DateTimePicker::make('check_out_at'),
                TextInput::make('late_minutes')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('work_minutes')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('status')
                    ->options(['present' => 'Present', 'absent' => 'Absent', 'leave' => 'Leave', 'holiday' => 'Holiday'])
                    ->required(),
                TextInput::make('check_in_method')
                    ->required()
                    ->default('manual'),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
