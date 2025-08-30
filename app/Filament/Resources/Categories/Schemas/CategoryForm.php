<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                ->disk('public')
                ->image()
                ->directory('categories')
                ->required()
                ->columnSpan(2),
                TextInput::make('name')
                ->required()
                ->debounce(500)
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    $set('slug', Str::slug($state));
                }),
                TextInput::make('slug')
                ->required(),
            ]);
    }
}
