<?php

namespace App\Filament\Resources\BoardingHouses\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BoardingHousesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                ImageColumn::make('thumbnail')
                ->disk('public'),
                TextColumn::make('city.name'),
                TextColumn::make('category.name'),
                TextColumn::make('price'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye'),

                EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil'),

                DeleteAction::make()
                    ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation(),
            ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
