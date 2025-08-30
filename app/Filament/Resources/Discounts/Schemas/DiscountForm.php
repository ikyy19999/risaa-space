<?php

namespace App\Filament\Resources\Discounts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DiscountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('code')->required(),

            TextInput::make('name')->required(),

            Select::make('type')
                ->options([
                    'percent' => 'Percent',
                    'nominal' => 'Nominal'
                ])->required(),
            TextInput::make('value')
                ->numeric()
                ->required(),
            DatePicker::make('start_date'),
            DatePicker::make('end_date'),
            ]);
    }
}
