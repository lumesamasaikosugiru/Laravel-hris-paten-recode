<?php

namespace App\Filament\Resources\ApplicantBiodatas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ApplicantBiodatasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ktp')
                    ->searchable(),
                TextColumn::make('fullname')
                    ->searchable(),
                TextColumn::make('gender')
                    ->badge(),
                TextColumn::make('birthday')
                    ->date()
                    ->sortable(),
                TextColumn::make('birthplace')
                    ->searchable(),
                TextColumn::make('address_street')
                    ->searchable(),
                TextColumn::make('address_district')
                    ->searchable(),
                TextColumn::make('address_city')
                    ->searchable(),
                TextColumn::make('address_province')
                    ->searchable(),
                TextColumn::make('marital_status')
                    ->badge(),
                TextColumn::make('religion')
                    ->searchable(),
                TextColumn::make('ethnicity')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('photo_path')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
