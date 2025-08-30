<?php

namespace App\Filament\Resources\BoardingHouses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BoardingHouseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            Tabs::make('Tabs')
            ->tabs([
            Tab::make('Main Information')
            ->schema([
                FileUpload::make('thumbnail')
                ->disk('public')
                ->image()
                ->directory('boarding_houses')
                ->required(),

                TextInput::make('name')
                ->required()
                ->debounce(500)
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    $set('slug', Str::slug($state));
                }),

                TextInput::make('slug')
                ->required(),
                
                Select::make('city_id')
                ->relationship('city', 'name')
                ->required(),

                Select::make('category_id')
                ->relationship('category', 'name')
                ->required(),

                RichEditor::make('description')
                ->required(),

                TextInput::make('price')
                ->numeric()
                ->prefix('IDR')
                ->required(),
                
                Textarea::make('address')
                ->required(),
            ]),

            Tab::make('Extra Treats')
            ->schema([
            Repeater::make('bonuses')
            ->relationship('bonuses')
                ->schema([
                FileUpload::make('image')
                ->disk('public')
                ->image()
                ->directory('bonuses')
                ->required(),

                TextInput::make('name')
                ->required(),

                TextInput::make('description')
                ->required(),
                ])
            ]),
            
            Tab::make('Room')
            ->schema([
                Repeater::make('rooms')
            ->relationship('rooms')
                ->schema([
                TextInput::make('name')
                ->required(),

                TextInput::make('room_type')
                ->required(),

                TextInput::make('square_feet')
                ->numeric()
                ->required(),

                TextInput::make('capacity')
                ->numeric()
                ->required(),

                TextInput::make('price_per_month')
                ->numeric()
                ->prefix('IDR')
                ->required(),

                Toggle::make('is_available')
                ->required(),

                Repeater::make('images')
                ->relationship('images')
                ->schema([
                    FileUpload::make('image')
                    ->disk('public')
                    ->image()
                    ->directory('rooms')
                    ->required(),
                ])
                ])
            ]),
        ])->columnSpan(2)
            ]);
    }
}
