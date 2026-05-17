<?php

namespace App\Filament\Resources\EmployeeCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required()
                    ->numeric(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('probation_months')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
